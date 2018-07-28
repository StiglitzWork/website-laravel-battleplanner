@extends('layouts.main')

<?php
  $flag = false;
  $floorsList = $map->floors()->get();
  if($floorsList->first()->floorNum != 0) {
    $flag = true;
  }
?>
@push('js')
@endpush

@push('css')
  <link rel="stylesheet" href="{{r_asset("css/maps/show.css")}}">
@endpush

@push ('js')
  <script>
    const MAP_ID = "{{$map->id}}";

    const FLOOR_SOURCES = [
      @foreach ($map->floors as $index => $floor)
        {"id": {{$floor->id}},"number": {{$floor->floorNum}}, "src" : "{{ $floor->src }}"},
      @endforeach
    ]
  </script>
  <script src="{{asset("js/maps/show.bundle.js")}}"></script>
@endpush

@section ('content')
    {{-- {{dd($map->floors->first())}} --}}
    <div class="buttonGroup col-12 text-center">
      <div class="float-left">
      </div>
      <div class="float-right">
      </div>
      <div class="float-none">
        <input type="color" id="head" name="color" value="#e66465" onChange="app.engine.changeColor(this.value)" />
        <button type="button" name="button" class="btn btn-primary" onclick="app.engine.changeFloor(-1)"><</button>
        @foreach ($map->floors as $index => $floor)
          <button type="button" name="button" id="floorSelector-{{$floor->id}}" class="btn btn-secondary floorSelector" onclick="app.engine.changeFloorById({{$floor->id}})" >{{$floor->name}}</button>
        @endforeach
        <button type="button" name="button" class="btn btn-primary" onclick="app.engine.changeFloor(1)">></button>
          <button type="button" name="button" class="btn btn-success" onclick="app.engine.changeFloor(-1)">Save</button>
      </div>
    </div>
    <div class="row" id="EngineContainer">
  		<div id="viewport">
  			<canvas id="background" class="fixed"></canvas>
  			<canvas id="overlay"
          class="fixed"
  				onmouseleave="app.engine.canvasLeave(event)" onmouseenter="app.engine.canvasEnter(event)"
  				ondragover="app.engine.canvasAllowDrop(event)" ondrop="app.engine.canvasDrop(event)"
  				onmousemove="app.engine.canvasMove(event)" onmousedown="app.engine.canvasDown(event)"
  				onmouseup="app.engine.canvasUp(event)"></canvas>
  		</div>
    </div>

@endsection
