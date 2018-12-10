@extends('layouts.main')

@push('js')

{{-- init --}}
<script type="text/javascript">
    const BATTLEPLAN_ID = {{$battleplan->id}};
</script>

<script src="{{r_asset("js/battleplan/show.bundle.js")}}"></script>

  <script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    
    /*
    *
    * Direct JS functions
    */

    function vote(value,battleplanId,dom){

    var tmp = dom;

    if (value > 0) {
        $("#vote-up-" + battleplanId ).addClass("vote-green")
        $("#vote-down-" + battleplanId ).removeClass("vote-red")
    } else{
        $("#vote-down-" + battleplanId ).addClass("vote-red")
        $("#vote-up-" + battleplanId ).removeClass("vote-green")
    }

    $.ajax({
        method: "POST",
        url: "/battleplan/vote",
        data: {
            value: value,
            battleplanId: battleplanId
        },

        success: function (result) {
            console.log(result);
            $("#vote-value-" + battleplanId ).html("Points: " + result);
        },

        error: function (result) {
            console.log(result);
        }
    });
    }

    function copyModal($id){
        $('#copy-id').val($id);
        $('#copy').modal('toggle');
    }

    function copy(){
    $.ajax({
        method: "POST",
        url: "/battleplan/copy",
        data: {
            battleplanId: $('#copy-id').val(),
            name: $('#battleplan_name').val()
        },

        success: function (result) {
            alert("Successfully copied to account!");
            $('#copy').modal('hide');
        },

        error: function (result) {
            console.log(result);
        }
    });
    }


  </script>
@endpush

@push('css')
  <link rel="stylesheet" href="{{r_asset("css/battleplan/show.css")}}">
@endpush

@section('content')
  
  <div class="row">
    <div class="col-12 text-center">
        <h1>Battleplan: {{$battleplan->name}}</h1>
        <h2>by: {{$battleplan->Owner->username}}</h2>
        <small id="vote-value-{{$battleplan->id}}">Points: {{$battleplan->voteSum()}}</small>
    </div>
  </div>

  @if (!$battleplan->public)
    <div class="row">
        <div class="col-12 text-center">
            <small style="color:red">This battleplan is private and is only visible to the owner</small>
        </div>
    </div>
  @endif


<div class="row">
    <div class="col-12 text-center">

        @if(Auth::user())
            @if ($battleplan->voted(1))
                <i class="fas fa-arrow-circle-up cursor-click vote-green" id="vote-up-{{$battleplan->id}}" onclick="vote(1,{{$battleplan->id}}, this)" data-toggle="tooltip" data-placement="top" title="Up Vote"></i>
            @else
                <i class="fas fa-arrow-circle-up cursor-click" id="vote-up-{{$battleplan->id}}" onclick="vote(1,{{$battleplan->id}}, this)" data-toggle="tooltip" data-placement="top" title="Up Vote"></i>
            @endif

            |

            @if ($battleplan->voted(-1))
                <i class="fas fa-arrow-circle-down cursor-click vote-red" id="vote-down-{{$battleplan->id}}" onclick="vote(-1,{{$battleplan->id}}, this)" data-toggle="tooltip" data-placement="top" title="Down Vote"></i>
            @else
                <i class="fas fa-arrow-circle-down cursor-click" id="vote-down-{{$battleplan->id}}" onclick="vote(-1,{{$battleplan->id}}, this)" data-toggle="tooltip" data-placement="top" title="Down Vote"></i>
            @endif

            |

            <i class="fas fa-clone cursor-click" id="copy-{{$battleplan->id}}" data-toggle="tooltip" data-placement="top" title="Copy to my account" onclick="copyModal({{$battleplan->id}})"></i>

        @else
            <small style="color:red">Please sign in to unlock more features</small>
        @endif

        
    </div>
</div>

<div class="row text-center">
    <div class="col-12 floorChanger">
        <button type="button" name="button" class="btn btn-primary sidebar-btn" onclick="app.engine.changeFloor(-1)" data-toggle="tooltip" data-placement="top" title="Keybind: Down arrow">Floor
            &darr;</button>
        <button type="button" name="button" class="btn btn-primary sidebar-btn" onclick="app.engine.changeFloor(1)" data-toggle="tooltip" data-placement="top" title="Keybind: Up arrow">Floor
            &uarr;</button>
    </div>    
</div>
<div class="row">
    {{-- Engine --}}
    <div class="row bg-dark" id="EngineContainer">
        <div id="viewport">
            <canvas id="background" class="fixed"></canvas>
            <canvas id="overlay" class="fixed" onmouseleave="app.engine.canvasLeave(event)" onmouseenter="app.engine.canvasEnter(event)" onmousemove="app.engine.canvasMove(event)" onmousedown="app.engine.canvasDown(event)" onmouseup="app.engine.canvasUp(event)"
            onmousedown="app.engine.canvasDown(event)" ondrop="app.engine.canvasDrop(event)" ondragover="app.engine.allowDrop(event)">
            </canvas>
        </div>
        <div id="snackbar"></div>
    </div>
</div>

<div class="operatorContainer float-right">
    <div class="col-md-12 col-sm-12" id="operatorSlotList">
        @foreach ($battleplan->slots as $key => $slot)
        <div class="row">
            @if (!$slot->operator || !$slot->operator->exists)
                <input type="image" id="operatorSlot-{{$slot->id}}" src="/media/ops/empty.png" class="op-icon operator-slot operator-border" style="border-color: black" />
            @else
                <input type="image" id="operatorSlot-{{$slot->id}}" src="{{$slot->operator->icon}}" class="op-icon operator-slot operator-border" style="border-color: #{{$slot->operator->colour}}" />
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('modals')

    <div class="modal" id="copy" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Copy Battleplan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="copy-id">
                    <h2>Save battleplan as</h2>
                    <input class="col-4 form-control inline col-12" id="battleplan_name" value="" type="text">
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" name="button" class="btn btn-success" onclick="copy()">Copy</button>
                </div>
            </div>
        </div>
    </div>

@endpush