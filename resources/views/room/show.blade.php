@extends('layouts.main')

@push('css')
  <link rel="stylesheet" href="{{r_asset("css/room/show.css")}}">
@endpush

@push ('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js" charset="utf-8"></script>
    <script type="text/javascript">
        const ROOM_CONN_STRING = "{{$room->connection_string}}";
        const LISTEN_SOCKET = io('{{$listenSocket}}');
        const USER_ID = {{Auth::User()->id}};
        const IS_OWNER = {{(Auth::User()->id == $room->Owner->id) ? "true" : "false"}};
    </script>
    <script src="{{r_asset("js/room/show.bundle.js")}}"></script>
@endpush

@section ('content')
    @include('room.collapse-topbar')
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
            <input type="hidden" id="EditingOperatorSlot" name="" value="">
            <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="home-tab">
              @include('room.new')
            </div>
            <div class="tab-pane fade" id="load" role="tabpanel" aria-labelledby="profile-tab">
              @include('room.load')
            </div>
          </div>

        </div>
        <div class="modal-footer">
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
