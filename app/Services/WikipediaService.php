<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WikipediaService
{
    public function getContext(string $topic): string
    {
        $response = Http::get(
            'https://en.wikipedia.org/api/rest_v1/page/summary/' . urlencode($topic)
        )->json();

        return $response['extract']
            ?? "No reliable Wikipedia context available.";
    }
}