<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
  protected $fillable = [
    'name', 'icon', 'colour', 'atk'
  ];

  public function battleplan() {
    return $this->belongsToMany('App\Models\Battleplan');
  }

  public function gadgets() {
    return $this->belongsToMany('App\Models\Gadget');
  }

  public function slots() {
    return $this->belongsToMany('App\Models\OperatorSlot');
  }
}
