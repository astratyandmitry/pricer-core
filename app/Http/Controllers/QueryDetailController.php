<?php

namespace App\Http\Controllers;

use App\Models\Query;
use Illuminate\View\View;

class QueryDetailController extends Controller
{
    /**
     * @param \App\Models\Query $query
     * @return \Illuminate\View\View
     */
    public function __invoke(Query $query): View
    {
        abort_unless($query->active, 403);

        return view('query.detail', [
            'query' => $query,
        ]);
    }
}
