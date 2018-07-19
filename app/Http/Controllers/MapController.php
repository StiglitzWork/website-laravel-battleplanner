<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;

class MapController extends Controller
{
    public function index(Request $request) {

      $maps = Map::orderBy('name', 'asc')->get();
      return view('maps.index', compact('maps'));
    }

    public function show($name) {

      $map = Map::find($name);

      return view('maps.show', compact('map'));
    }
}
