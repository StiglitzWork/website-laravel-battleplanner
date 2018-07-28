@extends('layouts.main')

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
        {"id": {{$floor->id}},"number": {{$floor->floorNum - 1}}, "src" : "{{ $floor->src }}"},
      @endforeach
    ]
  </script>
  <script src="{{asset("js/maps/show.bundle.js")}}"></script>
@endpush

@section ('content')
    {{dd($map->floors->first())}}
    <div class="buttonGroup col-12 text-center">
        <button type="button" name="button" onclick="app.engine.changeFloor(-1)"><</button>
        @foreach ($map->floors as $index => $floor)
          <button type="button" name="button" >{{$floor->id}}</button>
        @endforeach
        <button type="button" name="button" onclick="app.engine.changeFloor(1)">></button>
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
