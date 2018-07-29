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

  public function setBattleplan(Request $request){
    // define variables
    $room = Room::where("connection_string", $request->conn_string)->first();
    $battlePlanId = $request->battleplan;
    $room->battleplan_id = $battlePlanId;
    $room->save();
    return response()->json($room);
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
    // dd($conn_string);
    $room = Room::where("connection_string", $conn_string)->first();

    $maps = Map::orderBy('name', 'asc')->get();

    // Error handle room DNE
    if($room == null){
      return redirect()->route('Room.join')->with("error", ["error" => "Room not found!"]);
    } else{
      return view("room.show", compact("maps", "room"));

    }

  }

}
