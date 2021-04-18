<?php

namespace App\Http\Controllers;

use App\Models\Query;
use Illuminate\Http\Request;

class CreateQueryProcessController extends Controller
{
    public function __invoke(Request $request)
    {
        $payload = $request->validate([
            'value' => 'required|max:2500',
            'results_url' => 'required|max:1000',
        ]);

        $query = Query::create($payload);

        return redirect()->route('singleQuery', $query);
    }
}
