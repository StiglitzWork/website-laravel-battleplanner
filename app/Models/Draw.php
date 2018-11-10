<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Draw extends Model
{
    protected $fillable = [
        "battlefloor_id", "originX",
        "originY", "destinationX",
        "destinationY", "user_id", "saved",
        "drawable_id", "drawable_type"
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
     * Morph Productable
     *
     * @var array
     */
    public function drawable()
    {
        return $this->morphTo();
    }

    public function withMorph(){
        $morph = $this->drawable()->first();
        $this["drawable"] = $morph;
        return $this;
    }

}
