<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    protected $fillable = [
        "color", "lineSize"
    ];

    /*****
     Relationships
    *****/
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Morph Drawable
     *
     * @var array
     */
    public function Drawable()
    {
        return $this->morphOne('App\Models\Draw', 'drawable');
    }
}
