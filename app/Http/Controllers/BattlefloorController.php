<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Draw;
use App\Models\Battlefloor;
use App\Events\Battlefloor\CreateDraws;
use Auth;

class BattlefloorController extends Controller
{
    public function draw(Request $request){
        // Declarations
        $draws = [];

        // Acquire the battlefloor
        // $battlefloorId = $request->battlefloorId;

        // Create each draw
        foreach ($request->draws as $key => $draw) {

              $draws[] = Draw::create([
                "battlefloor_id" => $draw["battlefloorId"],
                // "battlefloor_id" => $draw->battlefloorId,
                "originX" => $draw["origin"]["x"],
                "originY" => $draw["origin"]["y"],
                "destinationX" => $draw["destination"]["x"],
                "destinationY" => $draw["destination"]["y"],
                "color"=> $draw["color"],
                "user_id" => Auth::User()->id
              ]);
          }

        // Fire event on listeners for socket.io
        event(new CreateDraws($draws, $request->conn_string, $request->userId));

        // Respond
        return response()->json($draws);
    }

}
