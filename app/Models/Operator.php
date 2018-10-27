<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
  protected $fillable = [
    'name', 'icon', 'colour'
  ];

  public function battleplan() {
    return $this->belongsToMany('App\Models\Battleplan');
  }

  public function gadgets() {
    return $this->belongsToMany('App\Models\Gadget');
  }
}
