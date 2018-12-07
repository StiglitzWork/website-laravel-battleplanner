<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Operator;

class OperatorSlot extends Model
{
   protected $fillable = [
     'operator_id', 'battleplan_id'
   ];

   /*****
    Relationships
   *****/
   public function battleplan() {
     return $this->belongsTo('App\Models\Battleplan');
   }

   public function operator() {
     return $this->belongsTo('App\Models\Operator');
   }

   /*****
     Public methods
   *****/
   public function setOperator($operatorId){
       if($operatorId == null){
           $this->operator_id = $operatorId;
       } else{
           $operator = Operator::findOrFail($operatorId);
           $this->operator_id = $operator->id;
       }
       $this->save();
   }

   public function copy($slot){
      $fields = $slot->toArray();

      unset($fields["id"]);
      unset($fields["battleplan_id"]);
      
      // replicate slot
      $this->fill($fields);
      $this->save();

    }
}
