<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $advert_id
 * @property float $price
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
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advert(): BelongsTo
    {
        return $this->belongsTo(Advert::class);
    }
}
