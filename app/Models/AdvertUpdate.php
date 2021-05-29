<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $advert_id
 * @property double $price
 * @property double $price_prev
 * @property double $price_diff
 *
 * @property \App\Models\Advert $advert
 */
class AdvertUpdate extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'price' => 'double',
        'price_prev' => 'double',
        'price_diff' => 'double',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advert(): BelongsTo
    {
        return $this->belongsTo(Advert::class)->latest();
    }

    /**
     * @return bool
     */
    public function createdLessThan15MinutesAgo(): bool
    {
        return $this->created_at->isAfter(now()->subMinutes(15));
    }
}
