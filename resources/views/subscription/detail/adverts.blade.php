@php /** @var \App\Models\Subscription $subscription */ @endphp

@if($subscription->adverts->isNotEmpty())
  <div id="items" class="mt-6 md:mt-12">
    <div class="text-lg lg:text-2xl font-medium flex items-center">
      <div>
        Объявления на {{ $subscription->marketplace->title }} ({{ $subscription->adverts->count() }})
      </div>
    </div>

    <table class="sortable " cellspacing="0" cellpadding="0" showSortDirection="true">
      <thead>
      <tr>
        <th compareMethod="text">Name</th>
        <th compareMethod="number">Age</th>
        <th compareMethod="text">Sex</th>
        <th compareMethod="date">SomeDate</th>
        <th compareMethod="text">Notes</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>Fred</td>
        <td>23</td>
        <td>Male</td>
        <td>1/4/1973</td>
        <td>Cool person, really, I like Fred's hair a lot.</td>
      </tr>
      <tr ischild="true" style="border-top:1px dotted #cccccc; font-style:italic">
        <td></td>
        <td colspan="4">Here's an ancillary row of information you may not have known about Fred.</td>
      </tr>
      <tr>
        <td>Melissa</td>
        <td>7</td>
        <td>Female</td>
        <td>12/9/1978</td>
        <td>Big on the cheez whiz.</td>
      </tr>
      <tr>
        <td>James</td>
        <td>12</td>
        <td>Male</td>
        <td>3/2/1985</td>
        <td>Loved and lost, got lost.</td>
      </tr>
      <tr>
        <td>Jerome</td>
        <td>18</td>
        <td>Male</td>
        <td>8/8/1967</td>
        <td>Hits vegas with a vengeance.</td>
      </tr>
      <tr>
        <td>Mary</td>
        <td>33</td>
        <td>Female</td>
        <td>2/5/1985</td>
        <td>Bought 44 .44 automatics and lost them all in the couch.</td>
      </tr>
      <tr>
        <td>Susan</td>
        <td>24</td>
        <td>Female</td>
        <td>4/1/1947</td>
        <td>Bea Arthur thought Susan was the coolest until the pickle incident.</td>
      </tr>
      <tr>
        <td>Jerry</td>
        <td>45</td>
        <td>Male</td>
        <td>5/2/1976</td>
        <td>Signs on the highway pointed Jerry to all the correct exits.</td>
      </tr>
      <tr>
        <td>Jim</td>
        <td>23</td>
        <td>Male</td>
        <td>9/3/1684</td>
        <td>Long since the cricket master.</td>
      </tr>
      <tr>
        <td>Samuel</td>
        <td>14</td>
        <td>Male</td>
        <td>3/8/1963</td>
        <td>Jack and Samuel made some beer, but it tasted bad.</td>
      </tr>
      <tr>
        <td>Melissa</td>
        <td>24</td>
        <td>Female</td>
        <td>4/5/2020</td>
        <td>Taste the ether and you'll go under. Melissa found this out the hard way.</td>
      </tr>
      <tr>
        <td>Margaret</td>
        <td>53</td>
        <td>Female</td>
        <td>1/1/1873</td>
        <td>Point your wings to the west and fly, fly, fly.</td>
      </tr>
      <tr>
        <td>Moonbeam</td>
        <td>43</td>
        <td>Female</td>
        <td>3/1/1897</td>
        <td>Jenny had a vision. Moonbeam was not it.</td>
      </tr>
      <tr>
        <td>Sam</td>
        <td>17</td>
        <td>Male</td>
        <td>6/9/1973</td>
        <td>See note for Samuel. Sam was the taster to discover the truth.</td>
      </tr>
      <tr>
        <td>Aaron</td>
        <td>45</td>
        <td>Male</td>
        <td>10/2/1378</td>
        <td>The Jazz era completely passed Aaron by.</td>
      </tr>
      <tr>
        <td>Zachary</td>
        <td>34</td>
        <td>Male</td>
        <td>11/4/1974</td>
        <td>This boy can jump. Sky. You know?</td>
      </tr>
      <tr>
        <td>Zed</td>
        <td>22</td>
        <td>Male</td>
        <td>12/24/1975</td>
        <td>Of course he's dead. His cricket date went by and he missed it.</td>
      </tr>
      <tr>
        <td>Jill</td>
        <td>68</td>
        <td>Female</td>
        <td>2/22/2000</td>
        <td>Lost in love and I don't know much. But Jill does.</td>
      </tr>
      <tr>
        <td>Francess</td>
        <td>34</td>
        <td>Female</td>
        <td>3/19/1991</td>
        <td>Shortly all will be organized, if Francess has her way.</td>
      </tr>
      <tr>
        <td>Jennifer</td>
        <td>12</td>
        <td>Female</td>
        <td>4/13/1967</td>
        <td>Let's be an honest pair of people about this...who knows what Jennifer was thinking that dark red day?</td>
      </tr>
      <tr>
        <td>Daniel</td>
        <td>51</td>
        <td>Male</td>
        <td>8/18/1994</td>
        <td>Haunting by the closeness of his name to "Danielle", Daniel struggled with his sexuality throughout his
          life.
        </td>
      </tr>
      <tr>
        <td>Torbjorn</td>
        <td>6</td>
        <td>Male</td>
        <td>4/6/1997</td>
        <td>Thor's hammer had nothing on the wrath of a Torbjorn enraged.</td>
      </tr>
      <tr>
        <td>Thaddeus</td>
        <td>2</td>
        <td>Male</td>
        <td>5/31/1998</td>
        <td>Quit clowning around and get your work done, boy.</td>
      </tr>
      <tr ischild="true" style="border-top:1px dotted #cccccc; font-style:italic">
        <td></td>
        <td colspan="4">Here's an ancillary row of information you may not have known about Thaddeus!</td>
      </tr>
      <tr>
        <td>Joram</td>
        <td>16</td>
        <td>Male</td>
        <td>3/5/1999</td>
        <td>Van side-swipped a crowd of Bavarian monkeys and yet failed to injure a single one.</td>
      </tr>
      <tr>
        <td>Halfdan</td>
        <td>3</td>
        <td>Male</td>
        <td>9/17/2004</td>
        <td>Belly up to the table and lay down your chips, the time for accounting has come.</td>
      </tr>
      </tbody>
      <tfoot>
      <tr>
        <td colspan="5">Total People: 24</td>
      </tr>
      </tfoot>
    </table>

    <table border="0" cellpadding="0" cellspacing="0" showSortDirection="true"
           class="w-full mt-3 md:mt-6 bg-white shadow-md rounded-md p-6 overflow-hidden sortable" sortBody="itemsBody">
      <thead>
      <tr class="bg-gray-500" style="word-spacing: 8px;">
        <th></th>
        <th class="text-left font-medium text-xs uppercase text-white p-4" compareMethod="text">
          Объявление
        </th>
        <th class="text-right font-medium text-xs uppercase text-white p-4 w-40" compareMethod="number">
          Изменение
        </th>
        <th class="text-right font-medium text-xs uppercase text-white p-4 w-40" compareMethod="number">
          Цена
        </th>
        <th class="text-right font-medium text-xs uppercase text-white p-4 w-32" compareMethod="date"
            defaultSort="true">
          Дата
        </th>
      </tr>
      </thead>
      <tbody id="itemsBody">
      @foreach($subscription->adverts as $advert)
        <tr class="border-t border-gray-100 hover:bg-gray-50 transition">
          <td class="pl-4 py-2 w-24" sortValue="{{ $advert->title }}">
            @if ($advert->image)
              <img src="{{ $advert->image }}" class="h-12 w-20 object-cover rounded-md">
            @else
              <div class="h-12 w-20 bg-gray-100 rounded-md flex items-center justify-center">
                <x-svg.no-photo class="text-gray-300"/>
              </div>
            @endif
          </td>
          <td class="p-4" sortValue="{{ $advert->title }}">
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
          <td class="p-4 text-right" sortValue="{{ $advert->latest_update->price_diff }}">
            @if ($advert->latest_update->price_diff < 0)
              <div class="text-red-500 font-medium">
                {{ $advert->latest_update->price_diff }}%
              </div>
            @elseif ($advert->latest_update->price_diff > 0)
              <div class="text-green-500 font-medium">
                {{ $advert->latest_update->price_diff }}%
              </div>
            @else
              <div class="text-gray-400 font-medium">
                0%
              </div>
            @endif
          </td>
          <td class="p-4 text-right" sortValue="{{ $advert->latest_update->price }}">
            <div class="leading-none text-gray-800">
              {{ price($advert->latest_update->price) }}
            </div>

            <div class="text-xs text-gray-500 inline-block leading-none mt-2">
              {{ price($advert->latest_update->price_prev) }}
            </div>
          </td>
          <td class="p-4 text-right" sortValue="{{ $advert->latest_update->created_at->format('d/m/Y H:i') }}">
            <div class="leading-none text-gray-800">
              {{ $advert->latest_update->created_at->format('H:i') }}
            </div>

            <div class="text-xs text-gray-500 inline-block leading-none mt-2">
              {{ $advert->latest_update->created_at->format('d.m.Y') }}
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
@endif

@push('scripts')
  <script src="http://phrogz.net/tmp/TableSort/tablesort.js"></script>
  <script src="http://phrogz.net/tmp/TableSort/virtualpointer.class.js"></script>
  <script>
    function GetTDSortValue(tr,colNum){
      return tr.childNodes[colNum].getAttribute('sortValue');
    }
  </script>
@endpush
