@php /** @var \App\Models\Advert $advert */ @endphp

@extends('layout.master')

@section('content')
  <div id="heading" class="flex items-center justify-between mb-12">
    <div class="md:flex items-center">
      <img src="{{ $advert->image }}" class="rounded-md shadow-md object-cover h-56 lg:h-40 w-full lg:w-64 mr-12" alt="">

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

  @if ($advert->updates->count() > 1)
    <div class="p-6 bg-white shadow-md rounded-md mb-12">
      <canvas id="myChart" width="100%" height="30vh"></canvas>
    </div>
  @endif

  @if($advert->updates->isNotEmpty())
    <div id="items">
      <div class="text-lg lg:text-2xl font-medium flex items-center">
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
              @else
                <div class="text-gray-400 font-medium">
                  0%
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
