<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
  protected $fillable = [
    'name', 'src', 'floorNum', 'map_id', 'battlefloor_id',
  ];

  public function map() {
    return $this->belongsTo('App\Models\Map', 'map_id', 'id');
  }

  public function battlefloor() {
    return $this->belongsTo('App\Models\Battlefloor', 'battlefloor_id', 'id');
  }
}
