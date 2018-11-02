<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gadget extends Model
{
  protected $fillable = [
    'name', 'icon', 'prime', 'general'
  ];

  public function operators() {
    return $this->belongsToMany('App\Models\Operator');
  }
}
