<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Jobs\InitialParseResultsPage;
use Illuminate\Http\RedirectResponse;

class QuerySyncController extends Controller
{
    /**
     * @param \App\Models\Subscription $query
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Subscription $query): RedirectResponse
    {
        InitialParseResultsPage::dispatch($query);

        return redirect()->route('query.detail', $query)->with('sync', true);
    }
}
