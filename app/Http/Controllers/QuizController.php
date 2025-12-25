<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QuizGeneratorService;

class QuizController extends Controller
{
    public function index()
    {
        return view('quiz.index');
    }

    public function generate(Request $request, QuizGeneratorService $quizService)
    {
        $request->validate([
            'topic' => 'required|string|max:255',
        ]);

        // Clear old quiz
        session()->forget('quiz');

        try {
            $quiz = $quizService->generate($request->topic);
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to generate quiz. Please try again.');
        }

        session(['quiz' => $quiz]);

        return view('quiz.quiz', compact('quiz'));
    }


    public function submit(Request $request)
    {
        $quiz = session('quiz');

        if (!$quiz) {
            return redirect('/')->with('error', 'Quiz expired.');
        }

        $answers = $request->input('answers', []); // may be partial
        $score = 0;

        foreach ($quiz as $i => $q) {
            $userAnswer = $answers[$i] ?? null; // ✅ SAFE

            if ($userAnswer !== null && $userAnswer === ($q['correct'] ?? null)) {
                $score++;
            }
        }

        return view('quiz.result', compact('quiz', 'answers', 'score'));
    }

}