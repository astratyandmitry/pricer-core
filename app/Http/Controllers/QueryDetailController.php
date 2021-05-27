<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\View\View;

class QueryDetailController extends Controller
{
    /**
     * @param \App\Models\Subscription $query
     * @return \Illuminate\View\View
     */
    public function __invoke(Subscription $query): View
    {
        abort_unless($query->active, 403);

        return view('query.detail', [
            'query' => $query,
        ]);
    }
}
