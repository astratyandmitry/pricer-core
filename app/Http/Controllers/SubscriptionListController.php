<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\View\View;

class SubscriptionListController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function __invoke(): View
    {
        return view('subscription.list', [
            'subscriptions' => Subscription::query()->with('latest_update', 'marketplace')->get(),
        ]);
    }
}
