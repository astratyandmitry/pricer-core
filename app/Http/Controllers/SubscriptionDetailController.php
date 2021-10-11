<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Subscription;

class SubscriptionDetailController extends Controller
{
    /**
     * @param \App\Models\Subscription $subscription
     * @return \Illuminate\View\View
     */
    public function __invoke(Subscription $subscription)
    {
        abort_if($subscription->trashed(), 403);

        $subscription->load('updates', 'latest_update');

        $adverts = $subscription->adverts()->with('latest_update')->latest('updated_at')->paginate(50);

        return view('subscription.detail', [
            'subscription' => $subscription,
            'adverts' => $adverts,
        ]);
    }
}
