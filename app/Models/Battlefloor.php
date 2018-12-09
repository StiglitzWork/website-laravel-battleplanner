<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Line;

class Battlefloor extends Model
{
    protected $fillable = [
    'battleplan_id', 'floor_id'
  ];

    /*****
    Relationships
    *****/
    public function floor()
    {
        return $this->belongsTo('App\Models\Floor');
    }

    public function battleplan()
    {
        return $this->belongsTo('App\Models\Battleplan', 'battleplan_id', 'id');
    }

    public function draws()
    {
        return $this->hasMany('App\Models\Draw', 'battlefloor_id');
    }

    public function drawsCopiable()
    {
        return $this->hasMany('App\Models\Draw', 'battlefloor_id')
            ->where('deleted', '=', false)
            ->where('saved', '=', true);
    }

    /*****
      Public methods
    *****/
    public function saveValues()
    {

        // Save the new lines
        foreach ($this->draws as $key => $draw) {

            // delete draws
            if($draw->deleted){
                $draw->drawable()->delete();
                $draw->delete();
            } else{
                $draw->saved = true;
                $draw->save();
            }

        }
        $this->save();
    }

    public function copy($battlefloor){
        // replicate draws
        foreach ($battlefloor->drawsCopiable as $key => $draw) {
            // dd($this->id);
            $newDraw = Draw::create([
                "battlefloor_id" => $this->id,
                "originX" => $draw->originX,
                "originY" => $draw->originY,
                "destinationX" => $draw->destinationX,
                "destinationY" => $draw->destinationY,
                "user_id" => $draw->user_id,
                "drawable_type" => $draw->drawable_type,
                "drawable_id" => $draw->id,
                "saved" => true
            ]);
            
            // dd($newDraw);

            $subDraw = $draw->drawable;
            $type = $draw->drawable_type;

            $fields = $subDraw->toArray();

            unset($fields["id"]);
            // $fields["saved"] = 1;

            $newSubType = $type::create($fields);

            $newDraw->drawable_id = $newSubType->id;
            $newDraw->save();

        }
    }

    public function undo()
    {
        // Undo unsaved lines
        foreach ($this->draws as $this->draws => $draw) {
            if (!$draw->saved) {
                $draw->delete();
            }

            if ($draw->deleted) {
                $draw->restore();
            }
        }
    }
}
