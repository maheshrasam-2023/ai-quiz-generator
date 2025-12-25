<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiClient implements AiClientInterface
{
    public function generate(string $prompt): string
    {
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent';

        $response = Http::post(
            $url . '?key=' . config('services.gemini.key'),
            [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]
        );

        if (!$response->successful()) {
            throw new \Exception('Gemini API failed');
        }

        return $response->json('candidates.0.content.parts.0.text');
    }
}