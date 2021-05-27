<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string $marketplace_key
 * @property string $title
 * @property string|null $url
 * @property double $price
 *
 * @property \App\Models\Marketplace $marketplace
 * @property \App\Models\AdvertUpdate[]|\Illuminate\Database\Eloquent\Collection $updates
 * @property \App\Models\AdvertUpdate $latest_update
 */
class Advert extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'price' => 'double',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marketplace(): BelongsTo
    {
        return $this->belongsTo(Marketplace::class, 'marketplace_key', 'key');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function updates(): HasMany
    {
        return $this->hasMany(AdvertUpdate::class)->latest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function latest_update(): HasOne
    {
        return $this->hasOne(AdvertUpdate::class)->latest();
    }

    /**
     * @return array
     */
    public function graphLabels(): array
    {
        return $this->updates
            ->reverse()->take(30)
            ->map(function (AdvertUpdate $update) {
                return $update->created_at->format('d.m.Y');
            })->values()->toArray();
    }

    /**
     * @return array
     */
    public function graphData(): array
    {
        return $this->updates
            ->reverse()->take(30)
            ->map(function (AdvertUpdate $update) {
                return $update->price;
            })->values()->toArray();
    }
}
