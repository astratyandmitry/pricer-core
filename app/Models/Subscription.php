<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $marketplace_key
 * @property string $title
 * @property string $url
 *
 * @property \App\Models\Marketplace $marketplace
 * @property \App\Models\SubscriptionUpdate[]|\Illuminate\Database\Eloquent\Collection $updates
 * @property \App\Models\SubscriptionUpdate $latest_update
 * @property \App\Models\Advert[]|\Illuminate\Database\Eloquent\Collection $adverts
 */
class Subscription extends Model
{
    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marketplace(): BelongsTo
    {
        return $this->belongsTo(Marketplace::class, 'marketplace_key', 'key');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function adverts(): HasManyThrough
    {
        return $this->hasManyThrough(Advert::class, AdvertToSubscription::class, 'subscription_id', 'id', 'id', 'advert_id')->latest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function updates(): HasMany
    {
        return $this->hasMany(SubscriptionUpdate::class)->latest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function latest_update(): HasOne
    {
        return $this->hasOne(SubscriptionUpdate::class)->latest();
    }
}