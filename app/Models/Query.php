<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Query
 *
 * @property int $id
 * @property string $value
 * @property string $results_url
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Query newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Query newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Query query()
 * @method static \Illuminate\Database\Eloquent\Builder|Query whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Query whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Query whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Query whereResultsUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Query whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Query whereValue($value)
 * @mixin \Eloquent
 * @property \App\Models\Advert[] $adverts
 */
class Query extends Model
{
    use HasFactory;

    protected $guarded = [];
}
