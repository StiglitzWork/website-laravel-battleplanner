<div class="row text-center toggles">
    {{-- Offset --}}
    <div class="col-md-1 text-center"></div>

    <div class="col-md-2 text-center">
        <button class="btn btn-primary col-10" type="button" data-toggle="collapse" data-target="#room_info">
            Info
        </button>
    </div>
    <div class="col-md-2 ">
        <button class="btn btn-primary col-10" type="button" data-toggle="collapse" data-target="#room_functions">
            Controls
        </button>
    </div>

    <div class="col-md-2 ">
        <button class="btn btn-primary col-10" type="button" data-toggle="collapse" data-target="#room_notes">
            Notes
        </button>
    </div>

    <div class="col-md-2 ">
        <button class="btn btn-primary col-10" type="button" data-toggle="collapse" data-target="#room_icons">
            Icons
        </button>
    </div>
    
    <div class="col-md-2 ">
        <button class="btn btn-primary col-10" type="button" data-toggle="modal" data-target="#helpModal">
            Help
        </button>
    </div>
</div>


{{-- Room info --}}
<div class="collapse " id="room_info">
    <div class="card card-body bg-dark m-0 p-0">

        <div class="row">
            <div class="col-4">
                <label class="inline connection" for="connection">Room #:</label>
                <input class="col-4 form-control inline" id="connection" value="{{$room->connection_string}}" type="text"
                    disabled>
            </div>
            <div class="col-4">
                <label for="owner">Room Owner:</label>
                <input class="col-4 form-control inline" id="owner" value="{{$room->Owner->username}}" type="text"
                    disabled>
            </div>
            <div class="col-4">
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

{{-- functionality --}}
<div class="collapse " id="room_functions">
    <div class="card card-body bg-dark m-0 p-0">

        <div class="row text-center mt-1">
            <div class="col-md-5 col-sm-12" id="operatorSlotList">

                @if ($room->battleplan != null)
                    @foreach ($room->battleplan->slots as $key => $slot)

                    @if ($room->Owner == Auth::User())
                    @if (!$slot->operator || !$slot->operator->exists)
                    <input type="image" id="operatorSlot-{{$slot->id}}" data-id="{{$slot->id}}" src="/media/ops/empty.png"
                        class="op-icon operator-slot operator-border" data-toggle="modal" data-target="#opModal" onclick="setEditingOperatorSlot($(this).data('id'))"
                        style="border-color: black" />
                    @else
                    <input type="image" id="operatorSlot-{{$slot->id}}" data-id="{{$slot->id}}" src="{{$slot->operator->icon}}"
                        class="op-icon operator-slot operator-border" data-toggle="modal" data-target="#opModal" onclick="setEditingOperatorSlot($(this).data('id'))"
                        style="border-color: #{{$slot->operator->colour}}" />
                    @endif
                    @else
                    @if (!$slot->operator || !$slot->operator->exists)
                    <input type="image" id="operatorSlot-{{$slot->id}}" data-id="{{$slot->id}}" src="/media/ops/empty.png"
                        class="op-icon operator-slot operator-border" style="border-color: black" />
                    @else
                    <input type="image" id="operatorSlot-{{$slot->id}}" data-id="{{$slot->id}}" src="{{$slot->operator->icon}}"
                        class="op-icon operator-slot operator-border" style="border-color: #{{$slot->operator->colour}}" />
                    @endif
                    @endif

                    @endforeach
                @endif
            </div>

            <div class="col-md-3 col-sm-12 mt-2" id="">
                <button type="button" name="button" class="btn btn-warning col-4" onclick="app.engine.changeTool(app.engine.toolLine)"><i class="fas fa-paint-brush"></i></button>
                <button type="button" name="button" class="btn btn-info col-4" onclick="app.engine.changeTool(app.engine.toolSquare)"><i class="fas fa-square"></i></button>    
                <button type="button" name="button" class="btn btn-danger col-4" onclick="app.engine.changeTool(app.engine.toolErase)"><i class="fas fa-eraser"></i></button>    
            </div>

            <div class="col-md-3 col-sm-12 text-center">
                {{-- Functionality --}}
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                        <div class="row mt-2">
                            @if ($room->Owner == Auth::User())
                            <button type="button" name="button" class="btn btn-info col-6" data-toggle="modal"
                                data-target="#mapModal">Load</button>
                            <button type="button" name="button" class="btn btn-success col-6" onclick="app.engine.save()">Save</button>
                            @endif
                        </div>
                        <div class="row mt-1">
                            <button type="button" name="button" class="btn btn-primary col-6" onclick="app.engine.changeFloor(-1)">Floor
                                &darr;</button>
                            <button type="button" name="button" class="btn btn-primary col-6" onclick="app.engine.changeFloor(1)">Floor
                                &uarr;</button>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 text-center mt-2">
                        <div class="col-12 text-center">
                            <div class="row text-center">
                                <label for="color">color</label><br>
                                <input type="color" id='colorPicker' name="color" value="#e66465" onChange="app.engine.changeColor(this.value)" />
                            </div>
                            <div class="row text-right">
                                <label for="color">Pen Size</label>
                                <input type="number" id='sizePicker' name="size" onChange="app.engine.changeSize(this.value)" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Notes --}}
<div class="collapse " id="room_notes">
    <div class="card card-body bg-dark m-0 p-0">

        <div class="row text-center">
            {{-- <div class="col-11 text-center" style="color:white"> --}}
                @if (Auth::user() == $room->Owner)
                @if ($room->battleplan && $room->battleplan->notes)
                <textarea class="form-control battleplan_notes" id="battleplan_notes">{{$room->battleplan->notes}}</textarea>
                @else
                <textarea class="form-control battleplan_notes" id="battleplan_notes"></textarea>
                @endif
                @else
                @if ($room->battleplan && $room->battleplan->notes)
                <textarea class="form-control battleplan_notes" id="battleplan_notes" disabled>{{$room->battleplan->notes}}</textarea>
                @else
                <textarea class="form-control battleplan_notes" id="battleplan_notes" disabled></textarea>
                @endif
                @endif
                {{-- </div> --}}
        </div>
    </div>
</div>

{{-- Notes --}}
<div class="collapse " id="room_icons">
    <div class="card card-body bg-dark m-0 p-0">

        <div class="row text-center">
                @foreach ($gadgets as $key => $gadget)
                    <img src="{{$gadget->icon}}" draggable="true" ondragstart="app.engine.drag(event)"  alt="" height="50px" width="50px">
                @endforeach
        </div>
    </div>
</div>

@push('js')
<script type="text/javascript">
    function setEditingOperatorSlot(id) {
        $("#EditingOperatorSlot").val(id);
    }

</script>
@endpush