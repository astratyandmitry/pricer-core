@php /** @var string $label */ @endphp
@php /** @var string $value */ @endphp
@php /** @var string $diff */ @endphp

<div class="text-center">
  <div class="flex items-center justify-center">
    <div class="font-medium text-gray-800">
      {{ number_format((int)$value) }} ₸
    </div>

    @isset($diff)
      @if ($diff > 0)
        <div class="flex items-center text-red-500">
          <svg class="h-5 w-5 ml-2 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
          </svg>
          <div>{{ abs($diff) }}%</div>
        </div>
      @elseif($diff < 0)
        <div class="flex items-center text-green-500">
          <svg class="h-5 w-5 ml-2 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                  d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
          </svg>
          <div>{{ abs($diff) }}%</div>
        </div>
      @endif
    @endisset
  </div>
  <div class="text-sm text-gray-500">
    {{ $label }}
  </div>
</div>
