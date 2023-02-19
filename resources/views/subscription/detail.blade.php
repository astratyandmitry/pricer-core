@php /** @var \App\Models\Subscription $subscription */ @endphp

@extends('layout.master')

@section('content')
  <div id="heading" class="md:flex items-center justify-between mb-6">
    <div class="flex items-center">
      <div class="text-xl lg:text-3xl font-medium md:flex items-center leading-none">
        <h1>
          {{ $subscription->title }}
        </h1>

        <a href="{{ $subscription->url }}" target="_blank" class="text-blue-600 hover:text-blue-700 leading-none">
          <span class="text-xs block md:hidden mt-1">Открыть страницу на {{ $subscription->marketplace->title }}</span>
          <x-svg.external-link class="hidden md:block h-8 w-8 ml-2"/>
        </a>
      </div>
    </div>

    <div class="hidden md:block">
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

  <div id="stats" class="bg-white shadow-md rounded-md p-3 md:p-6">
    @include('subscription._stats')
  </div>

  @include('subscription.detail.chart')

  @include('subscription.detail.adverts-grid')
@endsection
