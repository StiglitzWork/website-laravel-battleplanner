<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Battleplan;
use App\Models\Battlefloor;
use App\Models\Map;
use Auth;
class BattleplanController extends Controller
{
    public function new(Request $request){
      $floorCollection = [];
      $map = Map::findOrFail($request->map);
      $battleplan = Battleplan::create([
        'name' => "Untitled",
        'description' => "",
        'map_id' => $map->id,
        'owner' => Auth::User()->id
      ]);

      foreach ($map->floors as $key => $floor) {
        $battlefloor =Battlefloor::create([
          "floor_id" => $floor->id,
          "battleplan_id" => $battleplan->id,
          "drawing" => ""
        ]);
        //add to collection
        $floorCollection[] = Battlefloor::with('floor')->where('id', $battlefloor->id)->first();
      }

      return response()->json([
        "battleplan" => Battleplan::with('map')->where('id', $battleplan->id)->first(),
        "battlefloors" => $floorCollection,
      ]);
    }

    public function save(Request $request){
      $floorCollection = [];
      $map = Map::findOrFail($request->map);
      $battleplan = Battleplan::create([
        'name' => "Untitled",
        'description' => "",
        'map_id' => $map->id,
        'owner' => Auth::User()->id
      ]);

      foreach ($map->floors as $key => $floor) {
        $battlefloor =Battlefloor::create([
          "floor_id" => $floor->id,
          "battleplan_id" => $battleplan->id,
          "drawing" => ""
        ]);
        //add to collection
        $floorCollection[] = Battlefloor::with('floor')->where('id', $battlefloor->id)->first();
      }

      return response()->json([
        "battleplan" => Battleplan::with('map')->where('id', $battleplan->id)->first(),
        "battlefloors" => $floorCollection,
      ]);
    }
}
