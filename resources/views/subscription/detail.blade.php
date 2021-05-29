@php /** @var \App\Models\Subscription $subscription */ @endphp

@extends('layout.master')

@section('content')
  <div id="heading" class="flex items-center justify-between mb-6">
    <div class="flex items-center">
      <div class="text-3xl font-medium flex items-center">
        <h1>
          {{ $subscription->title }}
        </h1>

        <a href="{{ $subscription->url }}" target="_blank" class="text-blue-600 hover:text-blue-700">
          <x-svg.external-link class="ml-2"/>
        </a>
      </div>
    </div>

    <div>
      @if (session()->has('sync'))
        <div class="bg-green-200 text-green-700 text-xs font-medium px-4 py-2 rounded-full">
          Только что обновлено
        </div>
      @else
        <a href="{{ route('subscription.sync', $subscription) }}"
           class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium px-4 py-2 rounded transition">
          Обновить данные
        </a>
      @endif
    </div>
  </div>

  <div id="stats" class="bg-white shadow-md rounded-md p-6">
    @include('subscription._stats')
  </div>

  @include('subscription.detail.chart')

  @include('subscription.detail.adverts')
@endsection
