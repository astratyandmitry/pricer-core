<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\View\View;

class QueryListController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function __invoke(): View
    {
        return view('query.list', [
            'queries' => Subscription::query()->where('active', true)->get(),
        ]);
    }
}
