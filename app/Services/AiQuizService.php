<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AiQuizService
{
    public function generateQuiz(string $topic): array
    {
        $prompt = <<<PROMPT
            Generate exactly 5 multiple-choice questions on "{$topic}".

            Return ONLY valid JSON.
            Do NOT include markdown, code fences, or explanations.

            Format:
            [
            {
                "question": "",
                "options": {
                "A": "",
                "B": "",
                "C": "",
                "D": ""
                },
                "correct": "A"
            }
            ]
        PROMPT;

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
            throw new \Exception('Gemini error: ' . $response->body());
        }

        $text = $response->json('candidates.0.content.parts.0.text');

        // ✅ CLEAN MARKDOWN CODE BLOCKS
        $cleanJson = preg_replace('/```json|```/i', '', $text);
        $cleanJson = trim($cleanJson);

        $quiz = json_decode($cleanJson, true);

        if (!is_array($quiz)) {
            throw new \Exception(
                "Invalid JSON from Gemini after cleanup:\n" . $cleanJson
            );
        }

        return $quiz;
    }
}
