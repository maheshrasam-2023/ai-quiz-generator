@extends('layouts.app')

@section('content')

<h2>Answer All Questions</h2>

<form method="POST" action="/submit">
    @csrf

    @foreach($quiz as $i => $q)
        <div class="question-card">
            <p class="question-title">
                {{ $loop->iteration }}. {{ $q['question'] }}
            </p>

            @foreach($q['options'] as $key => $opt)
                <label class="option">
                    <input
                        type="radio"
                        name="answers[{{ $i }}]"
                        value="{{ $key }}"
                        {{ $loop->first ? 'required' : '' }}
                    >
                    <span>{{ $key }}. {{ $opt }}</span>
                </label>
            @endforeach
        </div>
    @endforeach

    <div class="submit-wrap">
        <button type="submit">Submit Quiz</button>
    </div>
</form>

@endsection