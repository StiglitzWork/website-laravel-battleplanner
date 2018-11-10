<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Line;
use App\Models\Draw;
use App\Models\Battlefloor;
use App\Events\Battlefloor\CreateDraws;
use Auth;

class BattlefloorController extends Controller
{
    public function line(Request $request)
    {
        // Declarations
        $draws = [];

        // Create each line
        foreach ($request->draws as $key => $requestDraw) {
            $line = Line::create([
                "color"=> $requestDraw["color"],
                "lineSize"=> 10,
            ]);

            $draw = Draw::create([
                "battlefloor_id" => $requestDraw["battlefloorId"],
                "originX" => $requestDraw["origin"]["x"],
                "originY" => $requestDraw["origin"]["y"],
                "destinationX" => $requestDraw["destination"]["x"],
                "destinationY" => $requestDraw["destination"]["y"],
                "user_id" => Auth::User()->id,
                "drawable_type" => "App\Models\Line",
                "drawable_id" => $line->id
            ]);
            $draws[] = $draw->withMorph();
        }

        // Fire event on listeners for socket.io
        event(new CreateDraws($draws, $request->conn_string, $request->userId));

        // Respond
        return response()->json($draws);
    }
}
