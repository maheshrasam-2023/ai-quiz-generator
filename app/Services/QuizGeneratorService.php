<?php

namespace App\Services;

use App\Services\AiClientInterface;
use App\Services\WikipediaService;

class QuizGeneratorService
{
    public function __construct(
        private AiClientInterface $aiClient,
        private WikipediaService $wikipedia
    ) {}

    public function generate(string $topic): array
    {
        $context = $this->wikipedia->getContext($topic);

        $prompt = <<<PROMPT
You are a strict JSON generator.

Use the context below:
{$context}

Generate exactly 5 multiple-choice questions on "{$topic}".

Rules:
- Return ONLY valid JSON
- Each question MUST contain:
  - question
  - options (A, B, C, D)
  - correct (one of A, B, C, D)
  - explanation

Format:
{
  "mcqs": [
    {
      "question": "",
      "options": {
        "A": "",
        "B": "",
        "C": "",
        "D": ""
      },
      "correct": "A",
      "explanation": ""
    }
  ]
}
PROMPT;

        $raw = $this->aiClient->generate($prompt);

        $clean = preg_replace('/```json|```/i', '', $raw);
        $decoded = json_decode(trim($clean), true);

        if (!isset($decoded['mcqs']) || !is_array($decoded['mcqs'])) {
            throw new \Exception('Invalid AI response structure');
        }

        $quiz = $decoded['mcqs'];

        // ✅ Normalize EACH question
        foreach ($quiz as &$q) {
            if (
                !isset($q['correct']) ||
                !isset($q['options'][$q['correct']])
            ) {
                $q['correct'] = array_key_first($q['options'] ?? []);
            }

            $q['explanation'] = $q['explanation'] ?? 'Explanation not available.';
        }
        unset($q);

        return $quiz;
    }
}