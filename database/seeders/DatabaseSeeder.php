<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);

        // Basics
        $this->call(MarketplaceSeeder::class);
        $this->call(SubscriptionSeeder::class);

        // Crawler
        $this->call(CrawlerProxySeeder::class);
        $this->call(CrawlerBrowserSeeder::class);
    }
}
