<?php

namespace App\Http\Controllers;

use App\Models\Query;
use App\Jobs\InitialParseResultsPage;

class ManualSyncQueryController extends Controller
{
    public function __invoke(Query $query)
    {
        InitialParseResultsPage::dispatch($query);

        return redirect()->route('singleQuery', $query)->with('manualSync', true);
    }
}
