@php /** @var \App\Models\Subscription $subscription */ @endphp

<div class="bg-white shadow-md rounded-md">
  <div class="flex items-center justify-between p-6">
    <div class="flex items-center">
      <h3 class="text-lg flex items-center">
        <a href="{{ route('subscription.detail', $subscription) }}" class="text-blue-600 hover:text-blue-700">
          {{ $subscription->title }}
        </a>
      </h3>

      <div class="bg-gray-100 text-xs font-medium px-2 py-1 ml-2 rounded-full text-gray-700">
        {{ $subscription->marketplace->title }}
      </div>
    </div>

    @if ($subscription->latest_update)
      <div class="text-sm text-gray-400">
        {{ $subscription->latest_update->created_at->diffForHumans() }}
      </div>
    @endif
  </div>

  <div class="p-6 border-t border-gray-100">
    @include('subscription._stats')
  </div>
</div>
