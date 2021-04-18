@php /** @var \App\Models\Query $query */ @endphp

@extends('_layout')

@section('content')
    <h1>Query: {{ $query->value }}</h1>

    <p>
        @if (session()->has('manualSync'))
            <strong style="color: green">Just Synced</strong>
        @else
            <a href="{{ route('manualSyncQuery', $query) }}">Manual Sync</a>
        @endif
    </p>
@endsection
