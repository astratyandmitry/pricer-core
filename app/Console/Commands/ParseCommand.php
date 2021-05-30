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
    protected $signature = 'pricer:parse {marketplace?}';

    /**
     * @return int
     */
    public function handle(): int
    {
        if ($selectedMarketplace = $this->argument('marketplace')) {
            /** @var \App\Models\Marketplace $marketplace */
            if ($marketplace = Marketplace::query()->where('key', $selectedMarketplace)->first()) {
                $this->parseSubscription($marketplace);
            } else {
                $this->error('Marketplace not found');

                return 0;
            }
        } else {
            /** @var \App\Models\Marketplace[] $marketplaces */
            $marketplaces = Marketplace::query()->get();

            foreach ($marketplaces as $marketplace) {
                $this->parseSubscription($marketplace);
            }
        }

        return 1;
    }

    /**
     * @param \App\Models\Marketplace $marketplace
     */
    private function parseSubscription(Marketplace $marketplace): void
    {
        $this->info("Working with «{$marketplace->key}» Marketplace");

        if ($marketplace->subscriptions->isEmpty()) {
            $this->warn("— No available subscriptions found");
        }

        foreach ($marketplace->subscriptions as $subscription) {
            if (optional($subscription->latest_update)->createdLessThan15MinutesAgo()) {
                $this->warn("— [{$subscription->id}] Subscription was parsed less than 15 minutes ago");

                continue;
            }

            $this->info("— [{$subscription->id}] Parsing subscription");

            ParseSubscription::dispatchNow($subscription);

            LogSubscriptionUpdate::dispatchNow($subscription);
        }
    }
}
