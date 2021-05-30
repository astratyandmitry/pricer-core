<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $key
 * @property string $title
 * @property boolean $proxy
 *
 * @property  \App\Models\Subscription[]|\Illuminate\Database\Eloquent\Collection $subscriptions
 */
class Marketplace extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class, 'marketplace_key', 'key');
    }
}
