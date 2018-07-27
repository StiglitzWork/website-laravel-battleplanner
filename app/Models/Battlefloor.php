<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Battlefloor extends Model
{
  protected $fillable = [
    'drawing', 'battleplan_id',
  ];


  public function floor() {
    return $this->hasOne('App\Models\Floor', 'battlefloor_id');
  }

  public function battleplan() {
    return $this->belongsTo('App\Models\Battleplan', 'battleplan_id', 'id');
  }
}
