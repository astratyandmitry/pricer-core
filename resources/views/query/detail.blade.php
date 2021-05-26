@php /** @var \App\Models\Query $query */ @endphp

@extends('layout.master')

@section('content')
  <div class="flex items-center justify-between mb-6">
    <div class="flex items-center">
      <div class="text-3xl font-medium flex items-center">
        <div class="text-blue-600 hover:text-blue-700">
          {{ $query->value }}
        </div>

        <a href="{{ $query->results_url }}" target="_blank" class="text-blue-600 hover:text-blue-700">
          <svg class="h-6 w-6 cursor-pointer ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
          </svg>
        </a>
      </div>

      <div class="bg-gray-200 text-sm font-medium px-3 py-1 ml-2 rounded-full text-gray-800">
        kolesa.kz
      </div>
    </div>

    @if (session()->has('sync'))
      <div class="text-sm text-green-600 font-medium">
        Только что обновлено
      </div>
    @else
      <a href="{{ route('query.sync', $query) }}"
         class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium px-4 py-2 rounded">
        Обновить данные
      </a>
    @endif
  </div>

  <div class="bg-white shadow-md rounded-md">
    <div class="grid grid-cols-4 p-6 space-x-6">
      <div class="text-center">
        <div class="font-bold flex items-center justify-center">
          436

          <div class="flex items-center text-gray-500">
            <svg class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>

            2
          </div>
        </div>
        <div class="text-sm text-gray-500">
          объявлений
        </div>
      </div>

      <div class="text-center">
        <div class="font-bold flex items-center justify-center">
          4,860,000 ₸

          <div class="flex items-center text-orange-500">
            <svg class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
            </svg>
            0.7%
          </div>
        </div>
        <div class="text-sm text-gray-500">
          средняя цена
        </div>
      </div>

      <div class="text-center">
        <div class="font-bold flex items-center justify-center">
          3,300,000 ₸

          <div class="flex items-center text-green-500">
            <svg class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
            </svg>
            5%
          </div>
        </div>
        <div class="text-sm text-gray-500">
          минимальная цена
        </div>
      </div>

      <div class="text-center">
        <div class="font-bold flex items-center justify-center">
          7,430,000 ₸

          <div class="flex items-center text-red-500">
            <svg class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
            </svg>

            16.2%
          </div>
        </div>
        <div class="text-sm text-gray-500">
          максимальная цена
        </div>
      </div>
    </div>
  </div>
@endsection
