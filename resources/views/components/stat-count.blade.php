@php /** @var string $label */ @endphp
@php /** @var string $value */ @endphp
@php /** @var string $diff */ @endphp

<div class="text-center">
  <div class="flex items-center justify-center">
    <div class="text-sm md:text-base font-medium text-gray-800">
      {{ number_format((int)$value) }}
    </div>

    @isset($diff)
      @if ($diff > 0)
        <div class="flex items-center text-green-500">
          <svg class="m-3 md:h-4 w-3 md:w-4 ml-1 md:ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4v16m8-8H4"/>
          </svg>

          <div>
            {{ number_format($diff) }}
          </div>
        </div>
      @elseif ($diff < 0)
        <div class="flex items-center text-red-500">
          <svg class="m-3 md:h-4 w-3 md:w-4 ml-1 md:ml-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"/>
          </svg>

          <div>
            {{ number_format(abs($diff)) }}
          </div>
        </div>
      @endif
    @endisset
  </div>
  <div class="text-xs md:text-sm text-gray-500">
    {{ $label }}
  </div>
</div>
