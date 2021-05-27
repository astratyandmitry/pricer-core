<?php

namespace App\Models;

/**
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Model extends \Illuminate\Database\Eloquent\Model
{
    /**
     * @var array
     */
    protected $guarded = [];
}
