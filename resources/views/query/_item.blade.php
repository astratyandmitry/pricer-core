@php /** @var \App\Models\Subscription $query */ @endphp

<div class="bg-white shadow-md rounded-md">
  <div class="flex items-center justify-between p-6">
    <div class="flex items-center">
      <div class="text-lg flex items-center">
        <a href="{{ route('query.detail', $query) }}" class="text-blue-600 hover:text-blue-700">
          {{ $query->value }}
        </a>

        <a href="{{ $query->results_url }}" target="_blank" class="text-blue-600 hover:text-blue-700">
          <svg class="h-4 w-4 cursor-pointer ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
          </svg>
        </a>
      </div>

      <div class="bg-gray-100 text-xs font-medium px-2 py-1 ml-2 rounded-full text-gray-700">
        kolesa.kz
      </div>
    </div>

    <div class="text-sm text-gray-400">
      Обновлено 15 мин. назад
    </div>
  </div>

  <div class="p-6 border-t border-gray-100">
    <div class="grid grid-cols-4 space-x-6">
      <div class="text-center">
        <div class="font-bold flex items-center justify-center">
          436

          <div class="flex items-center text-gray-500">
            <svg class="h-4 w-4 ml-2"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>

            2
          </div>
        </div>
        <div class="text-sm text-gray-500">
          объявлений
        </div>
      </div>

      <div class="text-center">
        <div class="font-bold flex items-center justify-center">
          4,860,000 ₸

          <div class="flex items-center text-orange-500">
            <svg class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
            </svg>
            0.7%
          </div>
        </div>
        <div class="text-sm text-gray-500">
          средняя цена
        </div>
      </div>

      <div class="text-center">
        <div class="font-bold flex items-center justify-center">
          3,300,000 ₸

          <div class="flex items-center text-green-500">
            <svg class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
            </svg>
            5%
          </div>
        </div>
        <div class="text-sm text-gray-500">
          минимальная цена
        </div>
      </div>

      <div class="text-center">
        <div class="font-bold flex items-center justify-center">
          7,430,000 ₸

          <div class="flex items-center text-red-500">
            <svg class="h-5 w-5 ml-2"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
            </svg>

            16.2%
          </div>
        </div>
        <div class="text-sm text-gray-500">
          максимальная цена
        </div>
      </div>
    </div>
  </div>
</div>
