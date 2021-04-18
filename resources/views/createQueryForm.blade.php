@extends('_layout')

@section('content')
    <h1>Create Query Form</h1>

    <form action="{{ route('createQueryProcess') }}" method="post">
        @csrf

        <p>
            <input type="text" name="value" placeholder="Name of the Query" value="{{ old('value') }}">
        </p>

        <p>
            <input type="url" name="results_url" placeholder="URL for getting search results"
                   value="{{ old('results_url') }}">
        </p>

        <p>
            <button type="submit">Create new Query</button>
        </p>
    </form>
@endsection
