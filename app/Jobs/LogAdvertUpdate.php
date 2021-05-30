<?php

namespace App\Jobs;

use App\Models\Advert;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LogAdvertUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
            if (optional($this->advert->latest_update)->createdLessThan15MinutesAgo()) {
                return;
            }

            $prev = $currentState->price;
            $diff = diff_percentage($prev, $this->price);
        }

        if ($currentState && ! $diff) {
            return;
        }

        $this->advert->updates()->create([
            'new' => $currentState === null,
            'price' => $this->price,
            'price_prev' => $prev,
            'price_diff' => $diff,
        ]);
    }
}
