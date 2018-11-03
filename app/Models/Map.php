<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
  protected $fillable = [
    'name', 'thumbsrc', 'comp', 'battleplan_id',
  ];

  /*****
   Relationships
  *****/
  public function floors() {
    return $this->hasMany('App\Models\Floor', 'map_id');
  }

  public function battleplan() {
    return $this->belongsTo('App\Models\Battleplan', 'battleplan_id', 'id');
  }
}
