<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
  protected $fillable = [
    'owner', 'connection_string',
  ];

  public function owner() {
    return $this->belongsTo('App\Models\User', 'owner', 'id');
  }

  public function battleplan() {
    return $this->hasOne('App\Models\Battleplan', 'room_id');
  }
}
