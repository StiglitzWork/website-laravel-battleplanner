<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;

class MapController extends Controller
{

    // Tells laravel you must be logged in to see any of these routes
    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);
    }

    public function index(Request $request) {
      $maps = Map::orderBy('name', 'asc')->get();
      return view('maps.index', compact('maps'));
    }

    public function show(Request $request, $name) {

      $map = Map::where('name', $name)->first();

      return view('maps.show', compact('map'));
    }
}
