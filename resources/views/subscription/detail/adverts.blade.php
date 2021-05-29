@php /** @var \App\Models\Subscription $subscription */ @endphp

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
          Цена
        </th>
        <th class="text-right font-medium text-xs uppercase text-white p-4 w-32">
          Дата
        </th>
      </tr>
      @foreach($subscription->adverts as $advert)
        <tr class="border-t border-gray-100 hover:bg-gray-50 transition">
          <td class="pl-4 py-2 w-24">
            @if ($advert->image)
              <img src="{{ $advert->image }}" class="h-12 w-20 object-cover rounded-md">
            @else
              <div class="h-12 w-20 bg-gray-100 rounded-md flex items-center justify-center">
                <x-svg.no-photo class="text-gray-300" />
              </div>
            @endif
          </td>
          <td class="p-4">
            <div class="leading-none">
              <a href="{{ route('advert.detail', $advert) }}" class="inline-block text-blue-600 hover:text-blue-700">
                {{ shorten($advert->title, 60) }}
              </a>
            </div>

            <a href="{{ $advert->url }}" target="_blank"
               class="text-xs text-gray-500 inline-block leading-none mt-2 hover:text-gray-700">
              {{ shorten($advert->url) }}
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
            <div class="leading-none text-gray-800">
              {{ price($advert->latest_update->price) }}
            </div>

            <div class="text-xs text-gray-500 inline-block leading-none mt-2">
              {{ price($advert->latest_update->price_prev) }}
            </div>
          </td>
          <td class="p-4 text-right">
            <div class="leading-none text-gray-800">
              {{ $advert->latest_update->created_at->format('H:i') }}
            </div>

            <div class="text-xs text-gray-500 inline-block leading-none mt-2">
              {{ $advert->latest_update->created_at->format('d.m.Y') }}
            </div>
          </td>
        </tr>
      @endforeach
    </table>
  </div>
@endif
