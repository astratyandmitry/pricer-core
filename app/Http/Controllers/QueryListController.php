<?php

namespace App\Http\Controllers;

use App\Models\Query;
use Illuminate\View\View;

class QueryListController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function __invoke(): View
    {
        return view('query.list', [
            'queries' => Query::query()->where('active', true)->get(),
        ]);
    }
}
