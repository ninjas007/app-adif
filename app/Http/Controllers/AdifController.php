<?php

namespace App\Http\Controllers;

use App\Models\Adif;
use Illuminate\Http\Request;
class AdifController extends Controller
{
    public function index(Request $request)
    {
        $data['type_menu'] = 'adif';
        $adif = Adif::where('user_id', auth()->user()->id)->first();
        $data['adif'] = [];
        if ($adif) {
            $collection = collect(json_decode($adif->contents));

            if ($request->search) {
                $collection = $collection->filter(function ($item) use ($request) {
                    return stripos($item->call, $request->search) !== false;
                });
            }

            $paginatedItems = app(HelperController::class)->customPaginate($collection, $request->record ?? 10);
            $data['adif'] = $paginatedItems;
        }

        return view('adif.index', $data);
    }

    public function upload(Request $request)
    {
        // dd($request->adif);

        // Validasi file
        $request->validate([
            'adif' => 'required|file',
        ]);

        // Ambil file yang diunggah
        $file = $request->file('adif');

        // Buka stream dari file
        $stream = fopen($file->getRealPath(), 'r');

        // Baca isi file baris per baris
        $content = '';
        while (($line = fgets($stream)) !== false) {
            $content .= $line;
        }

        // Tutup stream
        fclose($stream);

        // Ekstrak data menggunakan regex
        $pattern = '/<CALL:(\d+)>(?P<call>[^<]+).*?<QSO_DATE:(\d+)>(?P<qso_date>[^<]+).*?<TIME_ON:(\d+)>(?P<time_on>[^<]+).*?<BAND:(\d+)>(?P<band>[^<]+).*?<FREQ:(\d+)>(?P<freq>[^<]+).*?<MODE:(\d+)>(?P<mode>[^<]+)(.*?<OPERATOR:(\d+)>(?P<operator>[^<]+))?/s';
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        // Simpan hasil dalam array
        $results = [];
        foreach ($matches as $match) {
            $results[] = [
                'call' => removeSpace($match['call']),
                'qso_date' => removeSpace($match['qso_date']),
                'time_on' => removeSpace($match['time_on']),
                'band' => removeSpace($match['band']),
                'freq' => isset($match['freq']) ? removeSpace($match['freq']) : null,
                'mode' => isset($match['mode']) ? removeSpace($match['mode']) : null,
                'operator' => isset($match['operator']) ? removeSpace($match['operator']) : null,
            ];
        }

        // check user
        $adif = Adif::where('user_id', auth()->user()->id)->first();
        if (!$adif) {
            $adif = new Adif();
        }

        $adif->contents = json_encode($results);
        $adif->total = count($results);
        $adif->user_id = auth()->user()->id;
        $adif->save();

        return redirect('/')->with('success', 'Adif uploaded successfully');
    }
}
