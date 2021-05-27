<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class QueryNewProcessController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $payload = $request->validate([
            'value' => 'required|max:2500',
            'results_url' => 'required|max:1000',
        ]);

        $query = Subscription::query()->create($payload);

        return redirect()->route('query.detail', $query);
    }
}
