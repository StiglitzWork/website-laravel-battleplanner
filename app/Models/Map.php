<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
  protected $fillable = [
    'name', 'thumbsrc', 'comp',
  ];

  public function floors() {
    return $this->hasMany('App\Models\Floor', 'map_id');
  }
}
