<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $subscription_id
 * @property integer $adverts
 * @property integer $adverts_prev
 * @property integer $adverts_diff
 * @property double $price_min
 * @property double $price_min_prev
 * @property double $price_min_diff
 * @property double $price_max
 * @property double $price_max_prev
 * @property double $price_max_diff
 * @property double $price_avg
 * @property double $price_avg_prev
 * @property double $price_avg_diff
 *
 * @property \App\Models\Subscription $subscription
 */
class SubscriptionUpdate extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'adverts' => 'integer',
        'adverts_prev' => 'integer',
        'adverts_diff' => 'integer',
        'price_min' => 'double',
        'price_min_prev' => 'double',
        'price_min_diff' => 'double',
        'price_max' => 'double',
        'price_max_prev' => 'double',
        'price_max_diff' => 'double',
        'price_avg' => 'double',
        'price_avg_prev' => 'double',
        'price_avg_diff' => 'double',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
