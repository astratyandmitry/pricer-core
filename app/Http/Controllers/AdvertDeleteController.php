<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class AdvertDeleteController extends Controller
{
    /**
     * @param \App\Models\Advert $advert
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Advert $advert): JsonResponse
    {
        $advert->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
