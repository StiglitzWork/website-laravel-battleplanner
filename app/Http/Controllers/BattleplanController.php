<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Battleplan;
use App\Models\Battlefloor;
use App\Models\Room;
use App\Models\Map;
use Auth;
class BattleplanController extends Controller
{
    public function create(Request $request){
      // Declarations
      $floorCollection = [];

      // Find we are map instantiating
      $map = Map::findOrFail($request->map);

      // Create battleplan
      $battleplan = Battleplan::create([
        'map_id' => $map->id,
        'owner' => Auth::User()->id
      ]);

      // dd();
      return Battleplan::json($battleplan->id);
      return response()->json(Battleplan::json($battleplan->id));
    }

    public function update(Request $request){

      // Variable declaration

      $battleplan = Room::Connection($request->conn_string)->battleplan;

        // make sure the deleter is also the owner of the map
        if (!$this->isOwner($battleplan)) {
            return response()->json([
                "success" => false,
                "message" => "You do not own this battleplan."
            ]);
        }
        
        $battleplan->saveValues($request->name, $request->notes);

        // Respond
        return response()->json([
            'data' => $battleplan,
            "success" => true,
            "message" => "Successfully deleted!"
        ]);;
    }

    public function delete(Request $request){
      // Variable declaration
      $battleplan = Battleplan::findOrFail($request->battleplanId);

      // Check that deleter is the owner
      if (!$this->isOwner($battleplan)) {
          return response()->json([
              "success" => false,
              "message" => "You do not own this battleplan."
          ]);
      }

      // Do the delete
      $battleplan->delete();

      return response()->json([
          "success" => true,
          "message" => "Successfully deleted!"
      ]);
    }

    private function isOwner($battleplan){
        return $battleplan->Owner == Auth::User();
    }

}
