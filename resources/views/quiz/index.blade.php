@extends('layouts.app')

@section('content')
<h1>AI Quiz Builder</h1>

<form method="POST" action="/generate">
    @csrf

    <div class="form-row">
        <input
            type="text"
            name="topic"
            placeholder="Enter a topic (e.g. Photosynthesis, Mumbai)"
            required
        >

        <button type="submit">Generate Quiz</button>
    </div>
</form>
@endsection