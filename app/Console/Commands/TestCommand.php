<?php

namespace App\Console\Commands;

use App\Crawler\Crawler;
use App\Jobs\ParseSubscription;
use App\Jobs\LogSubscriptionUpdate;
use App\Models\Subscription;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'pricer:test {marketplace}';

    /**
     * @return int
     */
    public function handle(): int
    {
        /** @var \App\Models\Subscription $sub */
        $sub = Subscription::query()->where('marketplace_key', $this->argument('marketplace'))->first();

        ParseSubscription::dispatch($sub);

        LogSubscriptionUpdate::dispatch($sub);

        return 1;
    }
}
