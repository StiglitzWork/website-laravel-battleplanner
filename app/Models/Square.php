<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Square extends Model
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

    public function battlefloor()
    {
        return $this->belongsTo('App\Models\Battlefloor');
    }

    /**
     * Morph Drawable
     *
     * @var array
     */
    public function Drawable()
    {
        return $this->morphMany('App\Models\Draw', 'drawable');
    }
}
