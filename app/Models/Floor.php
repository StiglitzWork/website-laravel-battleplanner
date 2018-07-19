<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
  protected $fillable = [
    'map', 'src', 'floorNum',
  ];
}
