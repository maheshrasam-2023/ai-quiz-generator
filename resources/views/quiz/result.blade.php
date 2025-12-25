@extends('layouts.app')

@section('content')

<h2>Score: {{ $score }}/{{ count($quiz) }}</h2>

@foreach($quiz as $i => $q)
    <div class="question-card">
        <p><b>{{ $loop->iteration }}. {{ $q['question'] }}</b></p>

        {{-- USER ANSWER --}}
        @if(isset($answers[$i]))
            <p class="{{ $answers[$i] === ($q['correct'] ?? '') ? 'correct' : 'wrong' }}">
                <strong>Your Answer:</strong>
                {{ $answers[$i] }}
                –
                {{ $q['options'][$answers[$i]] ?? 'Invalid option' }}
            </p>
        @else
            <p class="wrong">
                <strong>Your Answer:</strong> Not Answered
            </p>
        @endif

        {{-- CORRECT ANSWER --}}
        <p>
            <strong>Correct:</strong>
            {{ $q['correct'] ?? '-' }}
            –
            {{ $q['options'][$q['correct']] ?? 'N/A' }}
        </p>

        {{-- EXPLANATION --}}
        <p>
            <strong>Explanation:</strong>
            {{ $q['explanation'] ?? 'N/A' }}
        </p>
    </div>
@endforeach

@endsection