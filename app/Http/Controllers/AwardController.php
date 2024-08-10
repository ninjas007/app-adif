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
        $awards = Award::with('usersAward')->get();

        $data['type_menu'] = 'award';
        $data['awards'] = $awards;
        $data['user'] = User::with('adif')->where('id', auth()->user()->id)->first();

        return view('award.index', $data);
    }

    public function create()
    {
        $data['type_menu'] = 'award';
        $data['user'] = User::with('adif')->where('id', auth()->user()->id)->first();

        return view('award.create', $data);
    }

    public function edit($id)
    {
        $data['type_menu'] = 'award';
        $data['award'] = Award::find($id);
        $data['user'] = User::with('adif')->where('id', auth()->user()->id)->first();

        return view('award.edit', $data);
    }

    public function update($id, Request $request)
    {
        // Validasi input
            $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'sometimes|file|image|max:2048',
            'qso' => 'required|string',
            'band' => 'required|string',
            'mode' => 'required|string',
            'member' => 'required|string',
        ]);

        // Membuat JSON dari inputan rules
        $rules = json_encode([
            'qso' => $request->input('qso'),
            'band' => $request->input('band'),
            'mode' => $request->input('mode'),
            'member' => $request->input('member'),
        ]);


        $award = Award::find($id);

        $award->name = $request->input('name');
        $award->description = $request->input('description');
        $award->rules = $rules;

        // Menghandle upload file image jika ada
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $award->path_image = $path;
        }

        // Menyimpan data ke database
        $award->save();

        return redirect('/award')->with('success', 'Award updated successfully');
    }

    public function destroy($id)
    {
        $award = Award::find($id);
        $award->delete();

        return redirect('/award')->with('success', 'Award deleted successfully');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'sometimes|file|image|max:2048',
            'qso' => 'required|string',
            'band' => 'required|string',
            'mode' => 'required|string',
            'member' => 'required|string',
        ]);

        // Membuat JSON dari inputan rules
        $rules = json_encode([
            'qso' => $request->input('qso'),
            'band' => $request->input('band'),
            'mode' => $request->input('mode'),
            'member' => $request->input('member'),
        ]);

        // Membuat instance baru Award
        $award = new Award();
        $award->name = $request->input('name');
        $award->description = $request->input('description');
        $award->rules = $rules;

        // Menghandle upload file image jika ada
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $award->path_image = $path;
        } else {
            $award->path_image = 'images/default.jpg';
        }

        // Menyimpan data ke database
        $award->save();

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('award.index')->with('success', 'Award berhasil disimpan.');
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

                        $explodeBand = explode(',', $ruleAward['band']);
                        $explodeMode = explode(',', $ruleAward['mode']);
                        $resultBand = false;
                        $resultMode = false;

                        // check band
                        if (count($explodeBand) > 0) {
                            foreach ($explodeBand as $band) {
                                if (strtoupper($item->band) == strtoupper($band)) {
                                    $resultBand = true;
                                    break;
                                }
                            }
                        }


                        if (count($explodeMode) > 0) {
                            foreach ($explodeMode as $mode) {
                                if (strtoupper($item->mode) == strtoupper($mode)) {
                                    $resultMode = true;
                                    break;
                                }
                            }
                        }

                        if ($resultBand && $resultMode) {
                            return true;
                        }

                        return false;
                    })
                    ->count();
                }

                if ($countQsoAdif > $ruleAward['qso']) {
                    $award->user_award()->updateOrCreate([
                        'user_id' => $userId,
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
