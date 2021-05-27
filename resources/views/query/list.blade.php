@php /** @var \App\Models\Subscription[]|\Illuminate\Database\Eloquent\Collection $queries */ @endphp

@extends('layout.master')

@section('content')
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-medium">
      Поисковые запросы
    </h1>

    <a href="{{ route('query.new') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium px-4 py-2 rounded">
      Новый запрос
    </a>
  </div>

  @each('query._item', $queries, 'query', 'query._empty')

  @include('query._form')
@endsection
