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
    // Tells laravel you must be logged in to see any of these routes
    public function __construct()
    {
        $this->middleware('auth', ['only' => ["copy", "vote", "delete", "update", "create", "delete"]]);
    }

    
    public function show(Request $request, Battleplan $battleplan){
        // dd( Auth::user()->isAdmin());
        if ($battleplan->public) {
            return view("battleplan.show", compact("battleplan"));
        }

        if (Auth::user() && Auth::user()->id == $battleplan->owner) {
            return view("battleplan.show", compact("battleplan"));
        }

        if(Auth::user() && Auth::user()->isAdmin()){
            return view("battleplan.show", compact("battleplan"));
        }

        // return view("battleplan.show", compact("battleplan"));

        abort("404");
    }

    public function copy(Request $request){
        $battleplan = Battleplan::findOrFail($request->battleplanId);
        if($request->name){
            return Battleplan::copy($battleplan, Auth::user(), $request->name);
        }
        return Battleplan::copy($battleplan, Auth::user(), "");
    }

    public function vote(Request $request){
        $value = $request->value;
        $battleplan = Battleplan::findOrFail($request->battleplanId);
        $battleplan->vote($value,Auth::user());
        return $battleplan->voteSum();
    }

    public function index(Request $request){
        $battleplans = Battleplan::publics();
        return view("battleplan.index", compact("battleplans") );
    }

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
        
        $battleplan->saveValues($request->name, $request->notes,  $request->public);

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

    public function getBattleplan(Request $request, Battleplan $battleplan){
        return response()->json(Battleplan::json($battleplan->id));
    }

    private function isOwner($battleplan){
        return $battleplan->Owner == Auth::User();
    }



}
