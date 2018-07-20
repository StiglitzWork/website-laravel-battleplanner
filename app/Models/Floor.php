<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
  protected $fillable = [
    'src', 'floorNum', 'map_id'
  ];

  public function map() {
    return $this->belongsTo('App\Models\Map', 'map_id', 'id');
  }
}
