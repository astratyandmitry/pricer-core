<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Advert
 *
 * @property int $id
 * @property string $page_url
 * @property float $current_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Advert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Advert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Advert query()
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereCurrentPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert wherePageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $title
 * @property string $url
 * @property float $price
 * @method static \Illuminate\Database\Eloquent\Builder|Advert wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advert whereUrl($value)
 */
class Advert extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function updates()
    {
        return $this->hasMany(AdvertUpdate::class);
    }
}
