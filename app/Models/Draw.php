<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Draw extends Model
{
    protected $fillable = [
        "battlefloor_id", "originX",
        "originY", "destinationX",
        "destinationY", "user_id", "saved",
        "drawable_id", "drawable_type", "deleted"
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
     * public Methods
     */
    
     public function restore(){
        $this->deleted = false;
        $this->save();
     }

     public function setDeleted(){
        $this->deleted = true;
        $this->save();
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

    /**
     * Scopes
     */
    public function scopeNotDeleted($query)
    {
        return $query->where('deleted', '=', false);
    }

}
