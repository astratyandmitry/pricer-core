<?php

namespace App\Http\Controllers;

use App\Models\Query;

class SingleQueryController extends Controller
{
    public function __invoke(Query $query)
    {
        return view('singleQuery', [
            'query' => $query,
        ]);
    }
}
