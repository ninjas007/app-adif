<?php

namespace App\Http\Controllers;

use App\Models\Adif;
use App\Models\Award;
use App\Models\User;
use Illuminate\Http\Request;

class AwardController extends Controller
{
    public function index()
    {
        $awards = Award::with('user_award')->get();

        $data['type_menu'] = 'award';
        $data['awards'] = $awards;
        $data['user'] = User::with('adif')->where('id', auth()->user()->id)->first();

        return view('award.index', $data);
    }

    public function sync(Request $request)
    {
        $userId = auth()->user()->id;
        $adif = Adif::where('user_id', $userId)->first();

        // get award where user_award is null
        $awards = Award::get();
        $status = 'error';
        $message = 'Error sync award';

        $contents = json_decode($adif->contents ?? [], true);
        if ($contents != null && count($contents) > 0) {
            $contents = collect($contents)->map(function ($item) {
                return (object) $item;
            });

            // check apakah awardnya memenuhi dengan file adif yang di upload user
            // jika ya, update user_award
            foreach ($awards as $award) {

                $ruleAward = json_decode($award->rules, true);
                // check total qso
                if (isset($ruleAward['qso'])) {
                    $countQsoAdif = $contents->count();
                }

                // check band and qso
                if (isset($ruleAward['band']) && $ruleAward['band'] != '') {
                    $countQsoAdif = $contents->filter(function ($item) use ($ruleAward) {
                        $result = $item->band == strtoupper($ruleAward['band']) || $item->band == strtoupper($ruleAward['band']);

                        // check mode
                        if (isset($ruleAward['mode']) && $ruleAward['mode'] != '' && $ruleAward['mode'] != 'MIXED') {
                            $result = $result && $item->mode == strtoupper($ruleAward['mode']) || $item->mode == strtoupper($ruleAward['mode']);
                        }

                        return $result;
                    })
                    ->count();
                }

                if ($countQsoAdif > $ruleAward['qso']) {
                    $award->user_award()->updateOrCreate([
                        'user_id' => auth()->user()->id,
                        'award_id' => $award->id
                    ]);
                }

                $status = 'success';
                $message = 'User Award Updated';
            }
        }

        return redirect()->back()->with($status, $message);
    }
}
