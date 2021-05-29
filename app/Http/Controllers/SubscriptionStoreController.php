<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SubscriptionStoreController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $payload = $request->validate([
            'title' => 'required|max:2500',
            'url' => 'required|max:1000',
        ]);

        $query = Subscription::query()->create($payload);

        return redirect()->route('subscription.detail', $query);
    }
}
