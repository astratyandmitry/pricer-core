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
            'key' => 'olx',
            'title' => 'OLX',
        ],
        [
            'key' => 'kolesa',
            'title' => 'Колёса',
        ],
        [
            'key' => 'kaspi',
            'title' => 'Kaspi',
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
