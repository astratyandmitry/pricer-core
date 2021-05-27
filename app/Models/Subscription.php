<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $marketplace_key
 * @property string $title
 * @property string $url
 *
 * @property \App\Models\Marketplace $marketplace
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
}
