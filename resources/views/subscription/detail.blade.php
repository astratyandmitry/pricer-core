@php /** @var \App\Models\Subscription $subscription */ @endphp

@extends('layout.master')

@section('content')
  <div id="heading" class="flex items-center justify-between mb-6">
    <div class="flex items-center">
      <div class="text-3xl font-medium flex items-center">
        <div>
          {{ $subscription->title }}
        </div>

        <a href="{{ $subscription->url }}" target="_blank" class="text-blue-600 hover:text-blue-700">
          <svg class="h-8 w-8 cursor-pointer ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
          </svg>
        </a>
      </div>
    </div>

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

  <div id="stats" class="bg-white shadow-md rounded-md p-6">
    @if ($subscription->latest_update)
      <div class="grid grid-cols-4 space-x-6">
        <x-stat-count
          label="объявлений"
          value="{{ $subscription->latest_update->adverts }}"
          diff="{{ $subscription->latest_update->adverts_diff }}"
        />

        <x-stat-price
          label="средняя цена"
          value="{{ $subscription->latest_update->price_avg }}"
          diff="{{ $subscription->latest_update->price_avg_diff }}"
        />

        <x-stat-price
          label="минимальная цена"
          value="{{ $subscription->latest_update->price_min }}"
          diff="{{ $subscription->latest_update->price_min_diff }}"
        />

        <x-stat-price
          label="максимальная цена"
          value="{{ $subscription->latest_update->price_max }}"
          diff="{{ $subscription->latest_update->price_max_diff }}"
        />
      </div>
    @else
      @include('subscription._empty')
    @endif
  </div>

  @if ($subscription->updates->count() > 1)
    <div class="p-6 bg-white shadow-md rounded-md mt-12">
      <canvas id="myChart" width="100%" height="30vh"></canvas>
    </div>
  @endif

  @if($subscription->adverts->isNotEmpty())
    <div id="items" class="mt-12">
      <div class="text-2xl font-medium flex items-center">
        <div>
          Объявления на {{ $subscription->marketplace->title }} ({{ $subscription->adverts->count() }})
        </div>
      </div>

      <table border="0" cellpadding="0" cellspacing="0"
             class="w-full mt-6 bg-white shadow-md rounded-md p-6 overflow-hidden">
        <tr class="bg-gray-500">
          <th class="text-left font-medium text-xs uppercase text-white p-4" colspan="2">
            Объявление
          </th>
          <th class="text-right font-medium text-xs uppercase text-white p-4 w-32">
            Изменение
          </th>
          <th class="text-right font-medium text-xs uppercase text-white p-4 w-40">
            Стоимость
          </th>
          <th class="text-right font-medium text-xs uppercase text-white p-4 w-40">
            Передыдущая
          </th>
        </tr>
        @foreach($subscription->adverts as $advert)
          @continue(!$advert->latest_update)
          <tr class="border-t border-gray-100 hover:bg-gray-50 transition">
            <td class="pl-4 py-2 w-24">
              @if ($advert->image)
                <img src="{{ $advert->image }}" class="h-12 w-24 object-cover rounded-md">
              @else
                <div class="h-12 w-24 bg-gray-100 rounded-md flex items-center justify-center">
                  <svg class="h-8 w-8 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                       stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="1" y1="1" x2="23" y2="23"/>
                    <path
                      d="M21 21H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h3m3-3h6l2 3h4a2 2 0 0 1 2 2v9.34m-7.72-2.06a4 4 0 1 1-5.56-5.56"/>
                  </svg>
                </div>
              @endif
            </td>
            <td class="p-4">
              <div class="leading-none">
                <a href="{{ route('advert.detail', $advert) }}" class="text-blue-600 hover:text-blue-700">
                  {{ $advert->title }}
                </a>
              </div>

              <a href="{{ $advert->url }}" target="_blank"
                 class="text-xs text-gray-500 inline-block leading-none mt-2 hover:text-gray-700">
                {{ $advert->url }}
              </a>
            </td>
            <td class="p-4 text-right">
              @if ($advert->latest_update->price_diff > 0)
                <div class="text-red-500 font-medium">
                  {{ $advert->latest_update->price_diff }}%
                </div>
              @elseif ($advert->latest_update->price_diff < 0)
                <div class="text-green-500 font-medium">
                  {{ $advert->latest_update->price_diff }}%
                </div>
              @else
                <div class="text-gray-400 font-medium">
                  0%
                </div>
              @endif
            </td>
            <td class="p-4 text-right">
              <div class="text-gray-800">
                {{ number_format($advert->latest_update->price) }} ₸
              </div>
            </td>
            <td class="p-4 text-right">
              <div class="text-gray-600">
                {{ number_format($advert->latest_update->price_prev) }} ₸
              </div>
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  @endif

  @if ($subscription->updates->count() > 1)
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.0/chart.min.js"
            integrity="sha512-yadYcDSJyQExcKhjKSQOkBKy2BLDoW6WnnGXCAkCoRlpHGpYuVuBqGObf3g/TdB86sSbss1AOP4YlGSb6EKQPg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      var ctx = document.getElementById('myChart')
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: @json($subscription->graphLabels()),
          datasets: [{
            data: @json(($subscription->graphData('price_avg'))),
            borderWidth: 2,
            borderColor: '#2563EB',
            label: 'Средняя цена',
          }, {
            data: @json(($subscription->graphData('price_max'))),
            borderWidth: 2,
            borderColor: '#DC2626',
            label: 'Максимальная цена',
          }, {
            data: @json(($subscription->graphData('price_min'))),
            borderWidth: 2,
            borderColor: '#059669',
            label: 'Минимальная цена',
          }]
        },
      })
    </script>
  @endif
@endsection
