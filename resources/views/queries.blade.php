@php /** @var \App\Models\Query[]|\Illuminate\Database\Eloquent\Collection $queries */ @endphp

@extends('_layout')

@section('content')
    <h1>Queries</h1>

    <a href="{{ route('createQueryForm') }}">
        Add Query
    </a>

    @if ($queries->isNotEmpty())
        <ul>
            @foreach($queries as $query)
                <li>
                    <h3>
                        <a href="{{ route('singleQuery', $query) }}">
                            {{ $query->value }}
                        </a>
                    </h3>
                </li>
            @endforeach
        </ul>
    @endif

    @if ($queries->isEmpty())
        <p>
            Empty
        </p>
    @endif
@endsection
