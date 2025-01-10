<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;

class LandingpageController extends Controller
{
    public function landingPage()
    {
        $client = new Client();
        $apiUrl = config('app.api_url') . '/api/data-desa';

        try {
            $response = $client->request('GET', $apiUrl, [
                'headers' => [
                    'secret-key' => config('app.secret_key')
                ]
            ]);

            $data = json_decode($response->getBody()->getContents());

            $allBerita = $data->data_berita ?? [];
            $berita = $this->paginateCollection($allBerita, 3, 'berita');

            $allPotensi = $data->data_potensi ?? [];
            $potensi = $this->paginateCollection($allPotensi, 3, 'potensi');

            return view('landingpage', compact('berita', 'potensi'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memuat data. Silakan coba lagi.']);
        }
    }

    protected function paginateCollection($items, $perPage, $pageName)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage($pageName);
        $collection = collect($items);
        $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->values();

        return new LengthAwarePaginator(
            $currentPageItems,
            $collection->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath(), 'pageName' => $pageName]
        );
    }

    public function showDetail($type, $slug)
    {
        $client = new Client();
        $apiUrl = config('app.api_url') . '/api/detail/' . $type . '/' . $slug;

        try {
            $response = $client->request('GET', $apiUrl, [
                'headers' => [
                    'secret-key' => config('app.secret_key')
                ]
            ]);

            $item = json_decode($response->getBody()->getContents());

            return view('detail', compact('item'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memuat data. Silakan coba lagi.']);
        }
    }
}
