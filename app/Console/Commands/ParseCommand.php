<?php

namespace App\Console\Commands;

use App\Models\Marketplace;
use App\Models\Subscription;
use Illuminate\Console\Command;
use App\Jobs\ParseSubscription;
use App\Jobs\LogSubscriptionUpdate;

class ParseCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'pricer:parse {marketplace}';

    /**
     * @return int
     */
    public function handle(): int
    {
        $marketplace = $this->argument('marketplace');

        if (! Marketplace::query()->where('key', $marketplace)->exists()) {
            $this->error('Marketplace not found');

            return 0;
        }

        /** @var \App\Models\Subscription[]|\Illuminate\Database\Eloquent\Collection $subscriptions */
        $subscriptions = Subscription::query()->where('marketplace_key', $marketplace)->get();

        if ($subscriptions->isEmpty()) {
            $this->error("No available subscription found for «{$marketplace}»");
        }

        foreach ($subscriptions as $subscription) {
            if (optional($subscription->latest_update)->createdLessThan15MinutesAgo()) {
                $this->error('Subscription has been parsed less than 15 minutes ago');

                continue;
            }

            $this->info("Parsing Subscription #{$subscription->id}");

            ParseSubscription::dispatch($subscription);

            LogSubscriptionUpdate::dispatch($subscription);
        }

        return 1;
    }
}
