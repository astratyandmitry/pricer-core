<?php

namespace App\Http\Controllers;

use App\Models\Query;

class QueriesController extends Controller
{
    public function __invoke()
    {
        return view('queries', [
            'queries' => Query::whereActive(true)->get(),
        ]);
    }
}
