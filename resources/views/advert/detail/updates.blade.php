@php /** @var \App\Models\Advert $advert */ @endphp

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
