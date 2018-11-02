<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperatorSlot extends Model
{
   protected $fillable = [
     'operator_id', 'battleplan_id'
   ];

   public function battleplan() {
     return $this->belongsTo('App\Models\Battleplan');
   }

   public function operator() {
     return $this->belongsTo('App\Models\Operator');
   }
}
