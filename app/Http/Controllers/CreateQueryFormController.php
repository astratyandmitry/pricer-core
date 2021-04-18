<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateQueryFormController extends Controller
{
    public function __invoke()
    {
        return view('createQueryForm');
    }
}
