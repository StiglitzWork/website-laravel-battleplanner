<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Square;
use App\Models\Line;
use App\Models\Icon;
use App\Models\Draw;
use App\Models\Battlefloor;
use App\Events\Battlefloor\CreateDraws;
use App\Events\Battlefloor\DeleteDraws;
use Auth;

class BattlefloorController extends Controller
{
    public function draw(Request $request)
    {
        // Declarations
        $draws = [];

        // Create each new draw
        foreach ($request->draws as $key => $draw) {
            // Create the specific draw type
            $subDraw;
            switch ($draw["drawable_type"]) {
                case 'Line':
                    $subDraw = $this->makeLine($draw["drawable"]);
                    break;
                
                case 'Square':
                    $subDraw = $this->makeSquare($draw["drawable"]);
                    break;

                case 'Icon':
                    $subDraw = $this->makeIcon($draw["drawable"]);
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
                "drawable_type" => "App\Models\\" . $draw["drawable_type"],
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

    private function makeSquare($object)
    {
        $square = Square::create([
            "color"=> $object["color"],
            "lineSize"=> $object["lineSize"],
        ]);
        return $square;
    }
    private function makeIcon($object)
    {
        $icon = Icon::create([
            "src"=> $object["src"],
        ]);
        return $icon;
    }

    public function deleteDraw(Request $request){
        // Declarations
        $deletedDraws = [];

        // Create each new draw
        foreach ($request->draws as $key => $draw) {
            // dd($request->draws);
            // Draw was never saved
            if(!$draw["id"]){
                continue;
            }

            $type = $draw["drawable_type"];

            // Make draw morph relationship
            $foundDraw = Draw::find($draw["id"]);
            if ($foundDraw) {
                $subObject = $foundDraw->drawable();
                
                // Add to the response object
                $deletedDraws[] = $foundDraw->withMorph();

                $subObject->delete();
                $foundDraw->delete();
            }

            // try {
            //     $subObject = $foundDraw->drawable();
            // } catch (\Throwable $th) {
            //     dd("Failed!",$draw,$foundDraw);
            // }
            
        }
        
        // Fire event on listeners for socket.io
        event(new DeleteDraws($deletedDraws, $request->conn_string, $request->userId));

        // Respond
        return response()->json($deletedDraws);
    }
}
