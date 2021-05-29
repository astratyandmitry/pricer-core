<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Jobs\ParseSubscription;
use Illuminate\Http\RedirectResponse;

class SubscriptionSyncController extends Controller
{
    /**
     * @param \App\Models\Subscription $subscription
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Subscription $subscription): RedirectResponse
    {
        ParseSubscription::dispatch($subscription);

        return redirect()->route('subscription.detail', $subscription)->with('sync', true);
    }
}
