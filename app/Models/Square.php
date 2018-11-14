<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Square extends Model
{
    protected $fillable = [
        "color", "lineSize"
    ];

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
