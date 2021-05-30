@php /** @var \App\Models\Advert $advert */ @endphp

@extends('layout.master')

@section('content')
  <div id="heading" class="flex items-center justify-between mb-12">
    <div class="md:flex items-center">
      <img src="{{ $advert->image }}" class="rounded-md shadow-md object-cover h-56 lg:h-40 w-full lg:w-64 mr-12"
           alt="">

      <div class="mt-3 md:mt-0">
        <div class="text-xl lg:text-3xl font-medium md:flex items-center leading-none">
          <div>
            {{ $advert->title }}
          </div>

          <a href="{{ $advert->url }}" target="_blank" class="text-blue-600 hover:text-blue-700 leading-none">
            <span class="text-xs block md:hidden mt-1">Открыть страницу на {{ $advert->marketplace->title }}</span>
            <x-svg.external-link class="hidden md:block h-8 w-8 ml-2"/>
          </a>
        </div>
      </div>
    </div>
  </div>

  @include('advert.detail.chart')

  @include('advert.detail.updates')
@endsection
