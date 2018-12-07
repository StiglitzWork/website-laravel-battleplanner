<?php

namespace App\Models;

use App\Models\OperatorSlot;
use App\Models\Map;
use App\Models\Vote;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Battleplan extends Model
{
    protected $fillable = [
        'name', 'description', 'owner', 'gametype_id', 'map_id', 'saved', 'notes', "public"
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

    public function votes()
    {
        return $this->hasMany('App\Models\Vote');
    }

    /*****
     public methods
    *****/
    public function vote($value, $user){

        $voteFound = Vote::search($user,$this);

        // Cannot divide by 0
        if($value == "0"){
            return false;
        }

        if( $voteFound){
            $voteFound->value = $value / abs($value);
            $voteFound->save();
        } else {
            Vote::create([
                "user_id" => $user->id,
                "battleplan_id" => $this->id,
                "value" => $value
            ]);
        }
    }

    public function voteSum(){
        $sum = 0;
        foreach ($this->votes as $key => $vote) {
            $sum += $vote->value;
        }
        return $sum;
    }

    public function voted($value){
        return Vote::search(Auth::user(), $this) && Vote::search(Auth::user(), $this)->value == $value;
    }

    /*****
     search
    *****/
    public static function publics(){
        return Battleplan::where("public" , true)
            ->where("saved", true)->get();
    }

    /*****
    Static methods
    *****/
    public static function json($id)
    {
        return Battleplan::where('id', $id)
            ->with("battlefloors")
            ->with("battlefloors.floor")
            ->with(['battlefloors.draws' => function ($q) {
                    $q->notDeleted()->with("drawable");
                }])
            ->with("slots")
            ->with("slots.operator")
            ->first();
    }

    public static function copy($battleplan, $user, $name){
        // replicate battleplan
        $newBattleplan = Battleplan::create([
            'map_id' => $battleplan->map->id,
            'owner' => $user->id,
            'name' => $name,
            'description' => $battleplan->description,
            'notes' => $battleplan->notes,
            'saved' => "1"
        ]);
        
        // replicate floors
        foreach ($newBattleplan->battlefloors as $key => $newFloor) {
            $oldFloor = $battleplan->battlefloors[$key];
            $newFloor->copy($oldFloor);
        }

        // replicate Slots
        foreach ($newBattleplan->slots as $key => $newSlot) {
            $oldSlot = $battleplan->slots[$key];
            $newSlot->copy($oldSlot);
        }

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

    public function saveValues($name = "", $notes = "", $public = false)
    {
        $this->name = $name;
        $this->saved = true;
        $this->notes = $notes;
        $this->public = $public;

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
