<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SubscriptionSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        [
            'marketplace_key' => 'olx',
            'title' => 'iPhone XR в Алматы',
            'url' => 'https://www.olx.kz/elektronika/telefony-i-aksesuary/mobilnye-telefony-smartfony/apple/alma-ata/q-iphone-xr/?search%5Bfilter_enum_state%5D%5B0%5D=used',
        ],
        [
            'marketplace_key' => 'olx',
            'title' => 'iPhone 12 Pro в Алматы',
            'url' => 'https://www.olx.kz/elektronika/telefony-i-aksesuary/mobilnye-telefony-smartfony/apple/alma-ata/q-iphone-12-pro/?search%5Bfilter_enum_state%5D%5B0%5D=used',
        ],
        [
            'marketplace_key' => 'market',
            'title' => 'iPhone XR в Алматы',
            'url' => 'https://market.kz/almaty/k--iphone-xr/?listingType=suggest_enter',
        ],
        [
            'marketplace_key' => 'market',
            'title' => 'iPhone 12 Pro в Алматы',
            'url' => 'https://market.kz/elektronika/telefony/mobilnye-telefony/k--iphone-12-pro/?listingType=suggest_cat',
        ],
        [
            'marketplace_key' => 'kolesa',
            'title' => 'Honda Accord 1994-97 в Алматы',
            'url' => 'https://kolesa.kz/cars/honda/accord/almaty/?_sys-hasphoto=2&auto-custom=2&auto-car-transm=2345&year[from]=1994&year[to]=1999',
        ],
        [
            'marketplace_key' => 'kolesa',
            'title' => 'Lexus IS 2005-08 в Алматы',
            'url' => 'https://kolesa.kz/cars/lexus/serii-is-vse/almaty/?_sys-hasphoto=2&auto-custom=2&auto-car-transm=2345&year[from]=2005&year[to]=2008',
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Subscription::query()->truncate();

        foreach ($this->data as $data) {
            Subscription::query()->create($data);
        }

        Schema::enableForeignKeyConstraints();
    }
}
