<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Battleplan extends Model
{
  protected $fillable = [
    'name', 'description', 'owner', 'gametype_id', 'map_id'
  ];

  public function owner() {
    return $this->belongsTo('App\Models\User', 'owner', 'id');
  }

  public function map() {
    return $this->hasOne('App\Models\Map', "id", 'map_id');
  }

  public function battlefloors() {
    return $this->hasMany('App\Models\Battlefloor', 'battleplan_id');
  }

  public function gametype() {
    return $this->belongsTo('App\Models\Gametype', 'gametype_id', 'id');
  }

  public function operators() {
    return $this->belongsToMany('App\Models\Operator');
  }
}
