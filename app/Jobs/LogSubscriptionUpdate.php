<?php

namespace App\Jobs;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LogSubscriptionUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\Models\Subscription
     */
    private $subscription;

    /**
     * @param \App\Models\Subscription $subscription
     */
    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        if ($this->subscription->adverts->isEmpty()) {
            return;
        }

        $sum = 0;
        $max = 0;
        $min = 0;

        foreach ($this->subscription->adverts as $advert) {
            $price = $advert->latest_update->price;

            $sum += $advert->latest_update->price;

            if (! $min) {
                $min = $price;
            } elseif ($price < $min) {
                $min = $price;
            }

            if (! $max) {
                $max = $price;
            } elseif ($price > $max) {
                $max = $price;
            }
        }

        $count = $this->subscription->adverts->count();
        $avg = $sum / $count;

        $count_prev = 0;
        $count_diff = 0;
        $min_prev = 0;
        $min_diff = 0;
        $max_prev = 0;
        $max_diff = 0;
        $avg_prev = 0;
        $avg_diff = 0;

        if ($currentState = $this->subscription->latest_update) {
            if (optional($this->subscription->latest_update)->createdLessThan15MinutesAgo()) {
                return;
            }

            $count_prev = $currentState->adverts;
            $count_diff = $count - $count_prev;
            $min_prev = $currentState->price_min;
            $min_diff = diff_percentage($min_prev, $min);
            $max_prev = $currentState->price_max;
            $max_diff = diff_percentage($max_prev, $max);
            $avg_prev = $currentState->price_avg;
            $avg_diff = diff_percentage($avg_prev, $avg);
        }

        if ($currentState && ! $count_diff && ! $min_diff && ! $max_diff && ! $avg_diff) {
            return;
        }

        $this->subscription->updates()->create([
            'adverts' => $count,
            'adverts_prev' => $count_prev,
            'adverts_diff' => $count_diff,
            'price_min' => $min,
            'price_min_prev' => $min_prev,
            'price_min_diff' => $min_diff,
            'price_max' => $max,
            'price_max_prev' => $max_prev,
            'price_max_diff' => $max_diff,
            'price_avg' => $avg,
            'price_avg_prev' => $avg_prev,
            'price_avg_diff' => $avg_diff,
        ]);
    }
}
