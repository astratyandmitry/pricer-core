<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use Illuminate\View\View;

class AdvertDetailController extends Controller
{
    /**
     * @param \App\Models\Advert $advert
     * @return \Illuminate\View\View
     */
    public function __invoke(Advert $advert): View
    {
        return view('advert.detail', [
            'advert' => $advert,
        ]);
    }
}
