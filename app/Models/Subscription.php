<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        return $this->hasManyThrough(Advert::class, AdvertToSubscription::class, 'subscription_id', 'id', 'id', 'advert_id')
            ->whereHas('latest_update', function (Builder $builder): Builder {
                //return $builder->where('new', true)->orWhere('price_diff', '!=', '0.0');

                return $builder;
            });
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

    /**
     * @return array
     */
    public function graphLabels(): array
    {
        return $this->updates
            ->reverse()->take(30)
            ->map(function (SubscriptionUpdate $update) {
                return $update->created_at->format('d.m.Y');
            })->values()->toArray();
    }

    /**
     * @param string $attribute
     * @return array
     */
    public function graphData(string $attribute): array
    {
        return $this->updates
            ->reverse()->take(30)
            ->map(function (SubscriptionUpdate $update) use ($attribute) {
                return $update->getAttribute($attribute);
            })->values()->toArray();
    }
}
