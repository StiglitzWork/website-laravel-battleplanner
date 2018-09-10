<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Draw;
class Battlefloor extends Model
{
  protected $fillable = [
    'battleplan_id', 'floor_id'
  ];

  public function floor() {
    return $this->belongsTo('App\Models\Floor');
  }

  public function battleplan() {
    return $this->belongsTo('App\Models\Battleplan', 'battleplan_id', 'id');
  }

  public function draws() {
    return $this->hasMany('App\Models\Draw');
  }

  public function getMissingDraws($alreadyHaveIds){
    return Draw::where("Battlefloor_id", $this->id)
      ->whereNotIn("id",$alreadyHaveIds)
      ->get();
  }
}
