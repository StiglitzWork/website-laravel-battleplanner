@extends('layouts.main')

@push('css')
  <link rel="stylesheet" href="{{r_asset("css/room/show.css")}}">
@endpush

@push ('js')
  <script type="text/javascript">
    const ROOM_CONN_STRING = "{{$room->connection_string}}";
  </script>
  <script src="{{r_asset("js/room/show.bundle.js")}}"></script>
@endpush

@section ('content')
    <div class="buttonGroup col-12 text-center">
      <div class="float-none text-center">

        <div class="row mb-2">
          <div class="col-4 text-left">
            <label class="inline connection" for="connection">Room #:</label>
            <input class="col-4 form-control inline" id="connection" value="{{$room->connection_string}}"type="text" disabled>
          </div>
          <div class="col-4 text-center">
            @if ($room->Owner == Auth::User())
              <button type="button" name="button" class="btn btn-info" data-toggle="modal" data-target="#mapModal">Load Map or Battleplan</button>
              <button type="button" name="button" class="btn btn-success" onclick="app.engine.save()">Save</button>
            @endif
            <button type="button" name="button" class="btn btn-info">Help</button>
          </div>
          <div class="col-4 owner text-right">
            <label for="owner">Room Owner:</label>
            <input class="col-4 form-control inline" id="owner" value="{{$room->Owner->username}}"type="text" disabled>
          </div>
        </div>

        <div class="row">
          <!-- OPERATOR SLOTS GO HERE -->
          <div class="col-1 padding-0">
            <div class="operator-rectangle text-centered" style="background-color:#dfdfdf;">
              <input type="image" src="/media/ops/empty.png" class="op-icon" data-toggle="modal" data-target="#opModal">
            </div>
          </div>
          <div class="col-1 padding-0">
            <div class="operator-rectangle text-centered" style="background-color:#dfdfdf;">
              <input type="image" src="/media/ops/empty.png" class="op-icon">
            </div>
          </div>
          <div class="col-1 padding-0">
            <div class="operator-rectangle text-centered" style="background-color:#dfdfdf;">
              <input type="image" src="/media/ops/empty.png" class="op-icon">
            </div>
          </div>
          <div class="col-1 padding-0">
            <div class="operator-rectangle text-centered" style="background-color:#dfdfdf;">
              <input type="image" src="/media/ops/empty.png" class="op-icon">
            </div>
          </div>


          <div class="col-4  text-center">
            <input type="color" id="head" name="color" value="#e66465" onChange="app.engine.changeColor(this.value)" />
            <button type="button" name="button" class="btn btn-primary" onclick="app.engine.changeFloor(-1)">Floor &darr;</button>
            <button type="button" name="button" class="btn btn-primary" onclick="app.engine.changeFloor(1)">Floor &uarr;</button>
          </div>
          <div class="col-4 battleplan text-right">
            <label for="battleplan">Battleplan Name:</label>
            @if ($room->Owner == Auth::User())
                <input class="col-4 form-control inline" id="battleplan_name" value="" type="text">
            @else
                <input class="col-4 form-control inline" id="battleplan_name" value="" type="text" disabled>
            @endif
          </div>
        </div>

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

@push('modals')
  <div class="modal" id="mapModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Load Map</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


          {{-- Pillbox --}}
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="new-tab" data-toggle="tab" href="#new" role="tab" aria-controls="new" aria-selected="true">New Map</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="load-tab" data-toggle="tab" href="#load" role="tab" aria-controls="load" aria-selected="false">Load Saved</a>
            </li>
          </ul>

          {{-- Pill content --}}
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="home-tab">
              @include('room.new')
            </div>
            <div class="tab-pane fade" id="load" role="tabpanel" aria-labelledby="profile-tab">
              @include('room.load')
            </div>
          </div>

        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


<!-- OPERATOR MODAL -->

  <div class="modal" id="opModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Select Operator</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          {{-- Pillbox --}}
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="atk-tab" data-toggle="tab" href="#atk" role="tab" aria-controls="atk" aria-selected="true">Attackers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="def-tab" data-toggle="tab" href="#def" role="tab" aria-controls="def" aria-selected="false">Defenders</a>
            </li>
          </ul>

          {{-- Pill content --}}
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="atk" role="tabpanel" aria-labelledby="home-tab">
              @include('room.atkOp')
            </div>
            <div class="tab-pane fade" id="def" role="tabpanel" aria-labelledby="profile-tab">
              @include('room.defOp')
            </div>
          </div>
        </div>

        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endpush
