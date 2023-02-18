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
            'marketplace_key' => 'krisha',
            'title' => 'Квартира мечты',
            'url' => 'https://krisha.kz/arenda/kvartiry/almaty/?das[_sys.hasphoto]=1&das[live.furniture][]=1&das[live.furniture][]=2&das[live.rooms][]=2&das[live.rooms][]=3&das[live.rooms][]=4&das[price][from]=250000&das[price][to]=350000',
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
