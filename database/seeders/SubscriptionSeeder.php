<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        [
            'marketplace_key' => 'kolesa',
            'title' => 'Toyota Camry 40 в Алматы',
            'url' => 'https://kolesa.kz/cars/avtomobili-s-probegom/toyota/camry/almaty/?_sys-hasphoto=2&auto-custom=2&year[from]=2006&year[to]=2013&price[from]=2000000&auto-car-order=1&auto-car-transm=2345',
        ],
        [
            'marketplace_key' => 'olx',
            'title' => 'Новые MacBook Pro в Алматы',
            'url' => 'https://www.olx.kz/elektronika/noutbuki-i-aksesuary/noutbuki/alma-ata/q-macbook-pro/?search%5Bfilter_enum_state%5D%5B0%5D=new',
        ],
        [
            'marketplace_key' => 'market',
            'title' => 'iPhone XR в Алматы',
            'url' => 'https://market.kz/almaty/k--iphone-xr/?listingType=suggest_enter',
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        foreach($this->data as $data) {
            Subscription::query()->create($data);
        }
    }
}
