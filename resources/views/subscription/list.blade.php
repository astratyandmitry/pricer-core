@php /** @var \App\Models\Subscription[]|\Illuminate\Database\Eloquent\Collection $subscription */ @endphp

@extends('layout.master')

@section('content')
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-medium">
      Поисковые запросы
    </h1>

    <a href="{{ route('subscription.new') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium px-4 py-2 rounded">
      Новый запрос
    </a>
  </div>

  <div class="space-y-4">
    @each('subscription._item', $subscriptions, 'subscription', 'subscription._empty')
  </div>

  @include('subscription._form')
@endsection
