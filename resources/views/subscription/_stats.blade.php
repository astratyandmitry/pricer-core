@php /** @var \App\Models\Subscription $subscription */ @endphp

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
