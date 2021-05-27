<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $advert_id
 * @property integer $subscription_id
 *
 * @property \App\Models\Advert $advert
 * @property \App\Models\Subscription $subscription
 */
class AdvertToSubscription extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advert(): BelongsTo
    {
        return $this->belongsTo(Advert::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
