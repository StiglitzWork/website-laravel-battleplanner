<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Battleplan extends Model
{
  protected $fillable = [
    'name', 'description', 'owner', 'room_id', 'gametype_id',
  ];


  public function owner() {
    return $this->belongsTo('App\Models\User', 'owner', 'id');
  }

  public function map() {
    return $this->hasOne('App\Models\Map', 'battleplan_id');
  }

  public function room() {
    return $this->belongsTo('App\Models\Room', 'room_id', 'id');
  }

  public function battlefloors() {
    return $this->hasMany('App\Models\Battlefloor', 'battleplan_id');
  }

  public function gametype() {
    return $this->belongsTo('App\Models\Gametype', 'gametype_id', 'id');
  }
}
