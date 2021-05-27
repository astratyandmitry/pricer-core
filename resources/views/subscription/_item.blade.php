@php /** @var \App\Models\Subscription $subscription */ @endphp

<div class="bg-white shadow-md rounded-md">
  <div class="flex items-center justify-between p-6">
    <div class="flex items-center">
      <div class="text-lg flex items-center">
        <a href="{{ route('subscription.detail', $subscription) }}" class="text-blue-600 hover:text-blue-700">
          {{ $subscription->title }}
        </a>
      </div>

      <div class="bg-gray-100 text-xs font-medium px-2 py-1 ml-2 rounded-full text-gray-700">
        {{ $subscription->marketplace->title }}
      </div>
    </div>

    <div class="text-sm text-gray-400">
      {{ $subscription->updated_at->diffForHumans() }}
    </div>
  </div>

  <div class="p-6 border-t border-gray-100">
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
</div>
