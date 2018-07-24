@extends('layouts.main')

<?php
  $flag = false;
  $floorsList = $map->floors()->get();
  if($floorsList->first()->floorNum != 0) {
    $flag = true;
  }
?>
@push('js')
  <script>
    var floor0 = new Image;
    var floor1 = new Image;
    var floor2 = new Image;
    var floor3 = new Image;
    var floor4 = new Image;
    var floor5 = new Image;
    var floorsArray = new Array();
    var count = 0;
    floorsArray.push(floor0, floor1, floor2, floor3, floor4, floor5);
    <?php foreach ($floorsList as $floor): ?>
      floorsArray[count].src = '{{$floor->src}}';
      count++;
    <?php endforeach; ?>
    count  = null;
  </script>
  <script src="{{r_asset("js/canvasMoveZoom.js")}}"></script>
@endpush

@push('css')
  <link rel="stylesheet" href="{{r_asset("css/index/index.css")}}">
@endpush

@section('content')
<div class="canvas-page">
  <div class="row row-margin">
    <div class="btn-group btn-group-lg col-centered no-padding">
      @foreach($floorsList as $floor)
        @if($floor->floorNum == 0)
          <input id="Basebtn" type="button" class = "btn btn-primary" value="Basement"
            onclick="selectFloor(0,{{$flag}});"/>
        @elseif($floor->floorNum == 10)
          <input id="Roofbtn" type="button" class = "btn btn-primary" value="Roof"
            onclick="selectFloor(10, {{$flag}});"/>
        @else
          <input id="{{$floor->floorNum}}btn" type="button" class="btn btn-primary"
            value="{{$floor->floorNum}}" onclick="selectFloor({{$floor->floorNum}}, {{$flag}});"/>
        @endif
      @endforeach
    </div>

    <div class="col-sm-12 canvas-padding">
      <canvas class="canvas" width="1800" height="800"></canvas>
    </div>
  </div>
</div>
@endsection
