<?php

namespace Database\Seeders;

use App\Models\Marketplace;
use Illuminate\Database\Seeder;

class MarketplaceSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [

        [
            'key' => 'krisha',
            'title' => 'Крыша',
            'proxy' => true,
        ],
        [
            'key' => 'kolesa',
            'title' => 'Колёса',
            'proxy' => true,
        ],
        [
            'key' => 'market',
            'title' => 'Маркет',
            'proxy' => true,
        ],
        [
            'key' => 'olx',
            'title' => 'OLX',
            'proxy' => false,
        ],
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        foreach($this->data as $data) {
            Marketplace::query()->create($data);
        }
    }
}
