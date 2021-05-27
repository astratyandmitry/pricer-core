@php /** @var \App\Models\Advert $advert */ @endphp

@extends('layout.master')

@section('content')
  <div id="heading" class="flex items-center justify-between mb-6">
    <div class="flex items-center">
      <div class="text-3xl font-medium flex items-center">
        <div>
          {{ $advert->title }}
        </div>

        <a href="{{ $advert->url }}" target="_blank" class="text-blue-600 hover:text-blue-700">
          <svg class="h-8 w-8 cursor-pointer ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
          </svg>
        </a>
      </div>
    </div>
  </div>

  @if ($advert->updates->count() > 1)
    <div class="p-6 bg-white shadow-md rounded-md mb-12">
      <canvas id="myChart" width="100%" height="30vh"></canvas>
    </div>
  @endif

  @if($advert->updates->isNotEmpty())
    <div id="items">
      <div class="text-2xl font-medium flex items-center">
        <div>
          Последние 100 обновлений
        </div>
      </div>

      <table border="0" cellpadding="0" cellspacing="0"
             class="w-full mt-6 bg-white shadow-md rounded-md p-6 overflow-hidden">
        <tr class="bg-gray-500">
          <th class="text-left font-medium text-xs uppercase text-white p-4">
            Дата
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
        @foreach($advert->updates->take(100) as $update)
          <tr class="border-t border-gray-100 hover:bg-gray-50 transition">
            <td class="p-4">
              {{ $update->created_at->format('d.m.Y H:i') }}
            </td>
            <td class="p-4 text-right">
              @if ($update->price_diff > 0)
                <div class="text-red-500 font-medium">
                  {{ $update->price_diff }}%
                </div>
              @elseif ($update->price_diff < 0)
                <div class="text-green-500 font-medium">
                  {{ $update->price_diff }}%
                </div>
              @endif
            </td>
            <td class="p-4 text-right">
              <div class="text-gray-800">
                {{ number_format($update->price) }} ₸
              </div>
            </td>
            <td class="p-4 text-right">
              <div class="text-gray-600">
                {{ number_format($update->price_prev) }} ₸
              </div>
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  @endif

  @if ($advert->updates->count() > 1)
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.0/chart.min.js"
            integrity="sha512-yadYcDSJyQExcKhjKSQOkBKy2BLDoW6WnnGXCAkCoRlpHGpYuVuBqGObf3g/TdB86sSbss1AOP4YlGSb6EKQPg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      var ctx = document.getElementById('myChart')
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: @json($advert->updates->map(function(\App\Models\AdvertUpdate $update) { return $update->created_at->format('d.m.Y'); })),
          datasets: [{
            data: @json($advert->updates->map(function(\App\Models\AdvertUpdate $update) { return $update->price; })),
            borderWidth: 2,
            borderColor: '#2563EB',
            label: '{{ $advert->title }}',
          }]
        },
      })
    </script>
  @endif
@endsection
