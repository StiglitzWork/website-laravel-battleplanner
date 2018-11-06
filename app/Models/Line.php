<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    protected $fillable = [
        "color",
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
}
