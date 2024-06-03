<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class HelperController extends Controller
{
    public function uploadFile(Request $request, string $name = 'photo'): string
    {
        $file = $request->file($name);

        // Menggabungkan informasi email dengan ekstensi file asli
        $fileName = $request->email . '.' . $file->getClientOriginalExtension();

        // make directory if not exists based on $name
        $directoryPath = base_path('public/img/' . $name);
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        // save file
        $file->move($directoryPath, $fileName);

        // return file path to show in input
        return 'img/' . $name . '/' . $fileName;
    }

    public function getAvatar($request): Request
    {
        $pathFile = $this->uploadFile($request);
        $request->merge(['avatar' => $pathFile]);

        return $request;
    }

    public function customPaginate(Collection $collection, int $limit) : LengthAwarePaginator
    {
        // Mengambil halaman saat ini dari query string
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Menentukan jumlah item per halaman
        $perPage = $limit;

        // Membagi koleksi sesuai dengan halaman saat ini dan jumlah item per halaman
        $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();

        // Membuat paginator
        $data = new LengthAwarePaginator($currentPageItems, $collection->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);


        return $data;
    }
}
