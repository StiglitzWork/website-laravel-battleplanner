<?php

namespace App\Models;
use App\Models\OperatorSlot;

use Illuminate\Database\Eloquent\Model;

class Battleplan extends Model
{
  protected $fillable = [
    'name', 'description', 'owner', 'gametype_id', 'map_id', 'saved'
  ];

  public function owner() {
    return $this->belongsTo('App\Models\User', 'owner', 'id');
  }

  public function map() {
    return $this->hasOne('App\Models\Map', "id", 'map_id');
  }

  public function battlefloors() {
    return $this->hasMany('App\Models\Battlefloor', 'battleplan_id');
  }

  public function gametype() {
    return $this->belongsTo('App\Models\Gametype', 'gametype_id', 'id');
  }

  public function saveDraws() {
    $battlefloors = $this->battlefloors;
    foreach ($battlefloors as $key => $battlefloor) {
        $battlefloor->saveDraws();
    }
  }

  public function removeUnsavedDraws() {
    $battlefloors = $this->battlefloors;
    foreach ($battlefloors as $key => $battlefloor) {
        $battlefloor->removeUnsavedDraws();
    }
  }

  public function slots() {
    return $this->hasMany('App\Models\OperatorSlot', 'battleplan_id');
  }

  // Create override
  public static function create(array $attributes = [])
    {
        $numberOfOperatorSlots = 5;
        // Parent Create method
        $model = static::query()->create($attributes);

        for ($i=0; $i < $numberOfOperatorSlots; $i++) {
            OperatorSlot::create([
                "battleplan_id" => $model->id
            ]);
        }
        // Create slots
        return $model;
    }

}
