<?php

namespace Database\Seeders;

use App\Models\CrawlerProxy;
use Illuminate\Database\Seeder;

class CrawlerProxySeeder extends Seeder
{
    /**
     * @var array
     */
    protected $data = [
        '191.101.163.127',
        '64.137.72.184',
        '50.114.85.104',
        '181.215.185.120',
        '181.215.29.45',
        '191.96.59.94',
        '102.129.240.108',
        '134.202.34.222',
        '154.16.211.49',
        '185.33.85.254',
    ];

    /**
     * @return void
     */
    public function run(): void
    {
        foreach ($this->data as $data) {
            CrawlerProxy::query()->create([
                'ip' => $data,
                'port' => '65233',
                'username' => 'astratyandmitry',
                'password' => 'B2a7ZvM',
                'expired_at' => '2021-06-02',
            ]);
        }
    }
}
