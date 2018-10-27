<?php

namespace App\Http\Controllers;
use App\Models\Room;
use App\Models\Map;
use App\Models\Battleplan;
use App\Models\Battlefloor;
use Illuminate\Http\Request;
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

  public function join(Request $request){
    return view("room.join");
  }

  public function new(Request $request){
    $room = Room::create(
      [
        'owner' => Auth::User()->id,
        'connection_string' => uniqid()
      ]
    );
    return redirect()->route("Room.show", ["conn_string" => $room->connection_string]);
  }

  public function saveBattleplan(Request $request) {
    $battleplan = Room::where("connection_string", $request->conn_string)->first()->battleplan;

    // make sure the deleter is also the owner of the map
    if ($battleplan->Owner != Auth::User()) {
        return false;
    }
    if ($battleplan) {
        $battleplan->saveDraws();
        $battleplan->name = $request->name;
        $battleplan->saved = true;
        $battleplan->save();
        return $battleplan;
    }
  }

  public function setBattleplan(Request $request){
    // define variables
    $room = Room::where("connection_string", $request->conn_string)->first();
    $battleplanId = $request->battleplan;
    $battleplan = Battleplan::find($battleplanId);
    $battleplan->removeUnsavedDraws();
    $room->battleplan_id = $battleplanId;
    $room->save();
    return response()->json($room);
  }

  public function deleteBattleplan(Request $request){
    $battleplanId = $request->battleplanId;
    $battleplan = Battleplan::find($battleplanId);

    // make sure the deleter is also the owner of the map
    if ($battleplan->Owner != Auth::User()) {
        return false;
    }

    $battleplan->delete();
    return true;
  }

  public function getBattleplan(Request $request){
    $room = Room::where("connection_string", $request->conn_string)->first();
    $floorCollection = [];


    // error handle
    if($room->battleplan_id == null){
      return null;
    }

    // build return objects
    $battleplan = $room->battleplan;

    foreach ($battleplan->battlefloors as $key => $battlefloor) {
      //add to collection
      $floorCollection[] = Battlefloor::with('floor')->where('id', $battlefloor->id)->first();
    }

    return response()->json([
      "battleplan" => Battleplan::with('map')->where('id', $battleplan->id)->first(),
      "battlefloors" => $floorCollection,
    ]);
  }

  public function show(Request $request,$conn_string){
    $room = Room::where("connection_string", $conn_string)->first();

    $maps = Map::orderBy('name', 'asc')->get();
    $battleplans = Battleplan::where('owner', Auth::User()->id)
        ->where('saved', true)
        ->get();

    // Error handle room DNE
    if($room == null){
      return redirect()->route('Room.join')->with("error", ["error" => "Room not found!"]);
    } else{
      return view("room.show", compact("maps", "room", 'battleplans'));
    }

  }

}
