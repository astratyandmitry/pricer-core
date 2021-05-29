@php /** @var \App\Models\Subscription[]|\Illuminate\Database\Eloquent\Collection $subscription */ @endphp

@extends('layout.master')

@section('content')
  <div class="flex items-center justify-between mb-3 md:lg-6">
    <h1 class="text-2xl lg:text-3xl font-medium">
      Поисковые запросы
    </h1>

    <div class="hidden md:block">
      <a href="{{ route('subscription.new') }}"
         class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium px-4 py-2 rounded">
        Новый запрос
      </a>
    </div>
  </div>

  <div class="space-y-2 md:space-y-4">
    @each('subscription._item', $subscriptions, 'subscription', 'subscription._empty')
  </div>

  @include('subscription._form')
@endsection
