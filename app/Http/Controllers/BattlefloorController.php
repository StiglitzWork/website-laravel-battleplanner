<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Line;
use App\Models\Draw;
use App\Models\Battlefloor;
use App\Events\Battlefloor\CreateLines;
use Auth;

class BattlefloorController extends Controller
{
    public function line(Request $request)
    {
        // Declarations
        $lines = [];

        // Create each line
        foreach ($request->lines as $key => $line) {
            // Create draw
            $draw = Draw::create([
                "battlefloor_id" => $line["battlefloorId"],
                "originX" => $line["origin"]["x"],
                "originY" => $line["origin"]["y"],
                "destinationX" => $line["destination"]["x"],
                "destinationY" => $line["destination"]["y"],
                "user_id" => Auth::User()->id
            ]);

            $lines[] = $draw->drawable()->create(Line::create([
                // "battlefloor_id" => $line["battlefloorId"],
                // "originX" => $line["origin"]["x"],
                // "originY" => $line["origin"]["y"],
                // "destinationX" => $line["destination"]["x"],
                // "destinationY" => $line["destination"]["y"],
                "color"=> $line["color"],
                "lineSize"=> 10,
                // "user_id" => Auth::User()->id
              ]));
        }

        // Fire event on listeners for socket.io
        event(new CreateLines($lines, $request->conn_string, $request->userId));

        // Respond
        return response()->json($lines);
    }
}
