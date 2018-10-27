<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gametype extends Model
{
  protected $fillable = [
    'name',
  ];

  public function battleplans() {
    return $this->hasMany('App\Models\Battleplans', 'gametype_id');
  }
}
