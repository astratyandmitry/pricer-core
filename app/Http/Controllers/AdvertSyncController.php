<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Jobs\InitialParseResultsPage;
use Illuminate\Http\RedirectResponse;

class AdvertSyncController extends Controller
{
    /**
     * @param \App\Models\Advert $advert
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Advert $advert): RedirectResponse
    {
        InitialParseResultsPage::dispatch($advert);

        return redirect()->route('advert.detail', $advert)->with('sync', true);
    }
}
