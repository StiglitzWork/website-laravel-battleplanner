<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gadget extends Model
{
  protected $fillable = [
    'name', 'icon', 'prime'
  ];

  public function operators() {
    return $this->belongsToMany('App\Models\Operator');
  }
}
