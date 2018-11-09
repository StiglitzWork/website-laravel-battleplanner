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

    /*****
      Public methods
    *****/

    public function saveValues()
    {

    // Save the new lines
        foreach ($this->draws as $key => $draw) {
            $draw->saved = true;
            $draw->save();
        }
        $this->save();
    }

    public function undo()
    {
        // Undo unsaved lines
        foreach ($this->draws as $this->draws => $draw) {
            if (!$draw->saved) {
                $draw->delete();
            }
        }
    }
}
