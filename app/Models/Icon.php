<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    protected $fillable = [
        "src"
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
