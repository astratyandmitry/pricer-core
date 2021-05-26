<?php

namespace App\Http\Controllers;

use App\Models\Query;
use App\Jobs\InitialParseResultsPage;
use Illuminate\Http\RedirectResponse;

class QuerySyncController extends Controller
{
    /**
     * @param \App\Models\Query $query
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Query $query): RedirectResponse
    {
        InitialParseResultsPage::dispatch($query);

        return redirect()->route('query.detail', $query)->with('sync', true);
    }
}
