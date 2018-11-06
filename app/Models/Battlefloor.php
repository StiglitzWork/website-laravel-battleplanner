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

    public function lines()
    {
        return $this->hasMany('App\Models\Line');
    }

    /*****
      Public methods
    *****/

    public function saveValues()
    {

    // Save the new lines
        foreach ($this->lines as $key => $line) {
            $line->saved = true;
            $line->save();
        }
        $this->save();
    }

    public function undo()
    {
        // Undo unsaved lines
        foreach ($this->lines as $this->lines => $line) {
            if (!$line->saved) {
                $line->delete();
            }
        }
    }
}
