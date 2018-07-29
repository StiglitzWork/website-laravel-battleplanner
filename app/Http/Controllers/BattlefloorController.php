<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Draw;
use App\Models\Battlefloor;
use Auth;
class BattlefloorController extends Controller
{
    public function update(Request $request){
      // return $request->all();
      $battlefloorId = $request->battlefloorId;
      $draws = [];
      foreach ($request->draws as $key => $draw) {
        // return $draw["origin"]["x"];
        $draws[] = Draw::create([
          "battlefloor_id" => $battlefloorId,
          "originX" => $draw["origin"]["x"],
          "originY" => $draw["origin"]["y"],
          "destinationX" => $draw["destination"]["x"],
          "destinationY" => $draw["destination"]["y"],
          "color"=> $draw["color"],
          "user_id" => Auth::User()->id
        ]);
      }

      return response()->json($draws);
    }

    public function getDraws(Request $request){
      // return $request->all();
      $battlefloorId = $request->battlefloorId;
      $alreadyHaveIds = $request->alreadyHaveIds;
      // dd($alreadyHaveIds);
      // return $alreadyHaveIds;
      if ($alreadyHaveIds == "") {
        $alreadyHaveIds = [];
      }
      $battlefloor = Battlefloor::findOrFail($battlefloorId);

      return response()->json($battlefloor->getMissingDraws($alreadyHaveIds));
    }
}
