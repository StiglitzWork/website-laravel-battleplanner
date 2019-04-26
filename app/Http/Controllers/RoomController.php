<?php

namespace App\Http\Controllers;
use App\Models\Room;
use App\Models\Map;
use App\Models\Battleplan;
use App\Models\Battlefloor;
use App\Models\Operator;
use App\Models\OperatorSlot;
use App\Models\Gadget;

use Illuminate\Http\Request;
use App\Events\Room\BattleplanChange;
use Auth;
class RoomController extends Controller
{
  // Tells laravel you must be logged in to see any of these routes
  public function __construct()
  {
      $this->middleware('auth', ['except' => []]);
  }

  public function index(){
    return view("room.index");
  }

  public function create(Request $request){

    // Create the room
    $room = Room::create([
        'owner' => Auth::User()->id,
        'connection_string' => uniqid()
    ]);

    // Respond with redirect
    return redirect()->route("Room.show", ["conn_string" => $room->connection_string]);
  }

  public function setBattleplan(Request $request){
    // define variables
    $room = Room::Connection($request->conn_string);
    $battleplan = Battleplan::findOrFail($request->battleplanId);

    // make sure the deleter is also the owner of the map
    if (!$this->isOwner($room)) {
        return $room;
        return response()->json([
            "success" => false,
            "message" => "You do not own the room."
        ]);
    }

    // Undo any unsaved work
    $battleplan->undo();

    // set the battleplan
    $room->battleplan_id = $battleplan->id;
    $room->save();

    // Fire event to listeners
    event(new BattleplanChange($room->connection_string));

    // Respond
    return response()->json($room);
  }

  public function getBattleplan($conn_string){
    // variable declaration
    $battleplan = Room::Connection($conn_string)->Battleplan;
    if($battleplan == null){
        return null;
    }
    return response()->json(Battleplan::json($battleplan->id));
  }

  public function show(Request $request, $conn_string){
    // Find correct room
    $room = Room::Connection($conn_string);

    // Gather relevant data
    $listenSocket = env("LISTEN_SOCKET");
    $maps = Map::orderBy('name', 'asc')->get();
    $atk_operators = Operator::attackers();
    $def_operators = Operator::defenders();
    $all_operators = Operator::all()
        ->sortBy(function($op) {
            return $op->name;
        });
    $gadgets = Gadget::all()
        ->sortBy(function($gadget) {
            return $gadget->name;
        });
    $battleplans = Battleplan::where('owner', Auth::User()->id)
        ->where('saved', true)
        ->get();

    // Error handle room DNE
    if($room == null){
      return redirect()->route('Room.index')->with("error", ["error" => "Room not found!"]);
    } else{
      return view("room.show", compact("maps", "room", 'battleplans', 'atk_operators', 'def_operators', 'all_operators', 'listenSocket','gadgets'));
    }

  }

  private function isOwner($room){
      return $room->Owner == Auth::User();
  }

}
