<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OperatorSlot;
use App\Models\Operator;
use App\Events\Battleplan\ChangeOperatorSlot;

class OperatorSlotController extends Controller
{
    public function update(Request $request){
        $operatorSlot = OperatorSlot::findOrFail($request->operatorSlotId);
        $operatorSlot->setOperator($request->operatorId);

        // Fire event on listeners for socket.io
        event(new ChangeOperatorSlot($request->conn_string, $operatorSlot->id));

        return response()->json([
            "operatorSlot" => $operatorSlot,
            "operator" => Operator::findOrFail($request->operatorId),
            "success" => true,
            "message" => "Operator has been changed"
        ]);
    }
}
