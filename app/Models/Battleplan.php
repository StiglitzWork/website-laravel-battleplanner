<?php

namespace App\Models;

use App\Models\OperatorSlot;
use App\Models\Map;

use Illuminate\Database\Eloquent\Model;

class Battleplan extends Model
{
    protected $fillable = [
        'name', 'description', 'owner', 'gametype_id', 'map_id', 'saved', 'notes'
    ];


    /*****
    Relationships
    *****/
    public function owner()
    {
        return $this->belongsTo('App\Models\User', 'owner', 'id');
    }

    public function map()
    {
        return $this->hasOne('App\Models\Map', "id", 'map_id');
    }

    public function battlefloors()
    {
        return $this->hasMany('App\Models\Battlefloor', 'battleplan_id');
    }

    public function gametype()
    {
        return $this->belongsTo('App\Models\Gametype', 'gametype_id', 'id');
    }

    public function slots()
    {
        return $this->hasMany('App\Models\OperatorSlot', 'battleplan_id');
    }


    /*****
    Static methods
    *****/
    public static function json($id)
    {
        return Battleplan::where('id', $id)
        // $bp = Battleplan::where('id', $id)
        ->with("battlefloors")
        ->with("battlefloors.floor")

        ->with(['battlefloors.draws' => function ($q) {
                $q->notDeleted()->with("drawable");
            }])
        // ->with("battlefloors.draws.drawable")
        
        // ->with("battlefloors.draws")
        // ->with("battlefloors.draws.drawable")


        ->with("slots")
        ->with("slots.operator")
        ->first();
        // dd($bp);
    }


    /*****
    Public methods
    *****/
    public function undo()
    {
        // Undo every battlefloor
        foreach ($this->battlefloors as $key => $battlefloor) {
            $battlefloor->undo();
        }
    }

    public function saveValues($name = "", $notes = "")
    {
        $this->name = $name;
        $this->saved = true;
        $this->notes = $notes;

        // save every battlefloor
        foreach ($this->battlefloors as $key => $battlefloor) {
            $battlefloor->saveValues();
        }
        $this->save(); // Calls Default Save
    }


    /*****
    Overrides
    *****/
    public static function create(array $attributes = [])
    {
        // variable declarations
        $map = Map::findOrFail($attributes["map_id"]);

        // Defaults
        $operatorSlots = (isset($attributes["operatorSlots"])) ? $attributes["operatorSlots"] : 5;
        $attributes["name"] = (isset($attributes["name"])) ? $attributes["name"] : "Untitled";
        $attributes["description"] = (isset($attributes["description"])) ? $attributes["description"] : "";
        $attributes["notes"] = (isset($attributes["notes"])) ? $attributes["notes"] : "";
        // Parent Create method
        $battleplan = static::query()->create($attributes);

        // Generate the number of operator slots
        for ($i=0; $i < $operatorSlots; $i++) {
            OperatorSlot::create([
                "battleplan_id" => $battleplan->id
            ]);
        }

        // Generate the number of battlefloors from map
        foreach ($map->floors as $key => $floor) {
            Battlefloor::create([
            "floor_id" => $floor->id,
            "battleplan_id" => $battleplan->id,
          ]);
        }

        // Create slots
        return $battleplan;
    }
}
