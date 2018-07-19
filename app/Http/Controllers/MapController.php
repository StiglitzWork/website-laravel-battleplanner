<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;

class MapController extends Controller
{
    public function index(Request $request) {

      $maps = Map::all();
      return view('map.index', compact('maps'));
    }
}
