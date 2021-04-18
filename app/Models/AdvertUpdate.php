<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdvertUpdate
 *
 * @property int $id
 * @property int $advert_id
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertUpdate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertUpdate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertUpdate query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertUpdate whereAdvertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertUpdate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertUpdate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertUpdate wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdvertUpdate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdvertUpdate extends Model
{
    use HasFactory;

    protected $guarded = [];
}
