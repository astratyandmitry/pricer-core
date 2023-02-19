@php /** @var \App\Models\Subscription $subscription */ @endphp
@php /** @var \App\Models\Advert[]|\Illuminate\Database\Eloquent\Collection $adverts */ @endphp

@if($adverts->isNotEmpty())
  <div id="items" class="mt-6 md:mt-12">
    <div class="text-lg lg:text-2xl font-medium flex items-center">
      <div>
        Объявления на {{ $subscription->marketplace->title }} ({{ $subscription->adverts->count() }})
      </div>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-4 mt-3 md:mt-6 ">
      @foreach($adverts as $advert)
        <div class="bg-white relative shadow-md rounded-md overflow-hidden">
          <div class="relative group">
            @if ($advert->latest_update->new)
              <div
                class="absolute z-10 top-2 left-2 px-2 py-1 rounded-full bg-red-100 text-red-600 text-xs font-bold inline-flex items-center leading-none">
                NEW
              </div>
            @endif

            <a href="{{ route('advert.delete', $advert) }}"
               class="js-delete opacity-0 group-hover:opacity-100 absolute inset-0 bg-red-700 bg-opacity-50 flex items-center justify-center text-white z-20">
              Удалить
            </a>

            @if ($advert->image)
              <img src="{{ $advert->image }}" class="w-full">
            @else
              <div class="h-12 w-20 bg-gray-100 rounded-md flex items-center justify-center">
                <x-svg.no-photo class="text-gray-300" />
              </div>
            @endif
          </div>

          <div class="pb-16">
            <div class="p-4">
              <div class="leading-none">
                {{--<a href="{{ route('advert.detail', $advert) }}" class="inline-block text-blue-600 hover:text-blue-700">--}}
                <a href="{{ $advert->url }}" class="inline-block text-blue-600 hover:text-blue-700">
                  {{ shorten($advert->title, 60) }}
                </a>

                <a href="{{ $advert->url }}" target="_blank"
                   class="text-xs text-gray-500 inline-block leading-none mt-2 hover:text-gray-700">
                  {{ $advert->description }}
                </a>
              </div>
            </div>
          </div>

          <div class="absolute inset-x-0 bottom-0 flex p-4 bg-gray-100 items-center justify-between">
            <div>
              <div class="leading-none text-gray-800">
                {{ price($advert->latest_update->price) }}
              </div>

              <div class="text-xs text-gray-500 inline-block leading-none mt-2">
                {{ price($advert->latest_update->price_prev) }}
              </div>
            </div>

            <div class="text-right">
              @if ($advert->latest_update->price_diff < 0)
                <div class="text-green-500 font-medium leading-none">
                  {{ $advert->latest_update->price_diff }}%
                </div>
                <div class="text-xs text-green-500 inline-block leading-none mt-2">
                  -{{ price($advert->latest_update->price_prev) }}
                </div>
              @elseif ($advert->latest_update->price_diff > 0)
                <div class="text-red-500 font-medium leading-none">
                  {{ $advert->latest_update->price_diff }}%
                </div>
                <div class="text-xs text-red-500 inline-block leading-none mt-2">
                  {{ price($advert->latest_update->price_prev) }}
                </div>
              @else
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-8 w-full">
      {{ $adverts->links('vendor.pagination.tailwind') }}
    </div>
  </div>
@endif

@push('scripts')
  <script>
    document.querySelectorAll('.js-delete').forEach(function (el) {
      el.addEventListener('click', function (e) {
        e.preventDefault();

        // if (confirm('Вы уверены, что хотите удалить объявление?')) {
          fetch(el.getAttribute('href'), {
            method: 'DELETE',
            headers: {
              'Content-Type': 'application/json',
            },
          }).then(function (response) {
            if (response.ok) {
              el.closest('.grid > div').remove();
            }
          });
        // }
      });
    });
  </script>
@endpush
