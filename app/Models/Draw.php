<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Draw extends Model
{
  protected $fillable = [
    "battlefloor_id", "originX","originY", "destinationX","destinationY", "color", "user_id", "saved"
  ];
  
  /*****
   Relationships
  *****/
  public function user() {
    return $this->belongsTo('App\Models\User');
  }

  public function battlefloor() {
    return $this->belongsTo('App\Models\Battlefloor');
  }

}
