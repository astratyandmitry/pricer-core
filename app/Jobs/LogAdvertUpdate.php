<?php

namespace App\Jobs;

use App\Models\Advert;
use Illuminate\Foundation\Bus\Dispatchable;

class LogAdvertUpdate
{
    use Dispatchable;

    /**
     * @var \App\Models\Advert
     */
    private $advert;

    /**
     * @var float
     */
    private $price;

    /**
     * @param \App\Models\Advert $advert
     * @param float $price
     */
    public function __construct(Advert $advert, float $price)
    {
        $this->advert = $advert;
        $this->price = $price;
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $prev = 0;
        $diff = 0;

        if ($currentState = $this->advert->latest_update) {
            if ($this->advert->latest_update->created_at->isAfter(now()->subMinutes(15))) {
                return;
            }

            $prev = $currentState->price;
            $diff = (1 - $prev / $this->price) * 100;
        }

        if ($currentState && ! $diff) {
            return;
        }

        $this->advert->updates()->create([
            'price' => $this->price,
            'price_prev' => $prev,
            'price_diff' => $diff,
        ]);
    }
}
