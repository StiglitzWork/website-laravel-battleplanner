<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
  protected $fillable = [
    'owner', 'connection_string', 'battleplan_id'
  ];

  public function Owner() {
    return $this->hasOne('App\Models\User', 'id', 'owner');
  }

  public function Battleplan() {
    return $this->belongsTo('App\Models\Battleplan');
  }

}
