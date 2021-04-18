<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdvertToQuery
 *
 * @property int $id
 * @property int $advert_id
 * @property int $query_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertToQuery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertToQuery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertToQuery query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertToQuery whereAdvertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertToQuery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertToQuery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertToQuery whereQueryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertToQuery whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdvertToQuery extends Model
{
    use HasFactory;
}
