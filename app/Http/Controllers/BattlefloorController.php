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
    public function draw(Request $request)
    {
        // Declarations
        $draws = [];

        $draws = $request->draws;

        // Create each new draw
        foreach ($draws as $key => $draw) {
            // Create the specific draw type
            $subDraw;
            switch ($draw["drawable_type"]) {
                case 'Line':
                    $subDraw = $this->makeLine($draw["drawable"]);
                    break;
            }

            // Make draw morph relationship
            $draw = Draw::create([
                "battlefloor_id" => $draw["battlefloor_id"],
                "originX" => $draw["originX"],
                "originY" => $draw["originY"],
                "destinationX" => $draw["destinationX"],
                "destinationY" => $draw["destinationY"],
                "user_id" => Auth::User()->id,
                "drawable_type" => "App\Models\Line",
                "drawable_id" => $subDraw->id
            ]);

            // Add to the response object
            $draws[] = $draw->withMorph();
        }
        
        // Fire event on listeners for socket.io
        event(new CreateDraws($draws, $request->conn_string, $request->userId));

        // Respond
        return response()->json($draws);
    }

    private function makeLine($object)
    {
        $line = Line::create([
            "color"=> $object["color"],
            "lineSize"=> $object["lineSize"],
        ]);
        return $line;
    }
}
