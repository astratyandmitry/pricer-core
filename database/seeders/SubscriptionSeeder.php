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
            'title' => 'Subaru Impreza на меху в Алматы',
            'url' => 'https://kolesa.kz/cars/subaru/impreza/almaty/?_sys-hasphoto=2&auto-car-transm=1',
        ],
        [
            'marketplace_key' => 'olx',
            'title' => 'Новые MacBook Pro в Алматы',
            'url' => 'https://www.olx.kz/elektronika/noutbuki-i-aksesuary/noutbuki/alma-ata/q-macbook-pro/?search%5Bfilter_enum_state%5D%5B0%5D=new',
        ],
        [
            'marketplace_key' => 'kaspi',
            'title' => 'Apple iPhone 12 Pro 128Gb синий',
            'url' => 'https://kaspi.kz/shop/p/apple-iphone-12-pro-128gb-sinii-100657202',
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
