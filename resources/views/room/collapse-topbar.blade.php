<div class="row text-center toggles">
    <div class="col-3 text-center">
        <button class="btn btn-primary col-10" type="button" data-toggle="collapse" data-target="#room_info">
            Info
        </button>
    </div>
    <div class="col-3">
        <button class="btn btn-primary col-10" type="button" data-toggle="collapse" data-target="#room_functions">
            Controls
        </button>
    </div>


    <div class="col-3">
        <button class="btn btn-primary col-10" type="button" data-toggle="collapse" data-target="#room_notes">
            Notes
        </button>
    </div>

    <div class="col-3">
        <button class="btn btn-primary col-10" type="button" data-toggle="collapse" data-target="#room_help">
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
                <input class="col-4 form-control inline" id="connection" value="{{$room->connection_string}}" type="text" disabled>
          </div>
          <div class="col-4">
                <label for="owner">Room Owner:</label>
                <input class="col-4 form-control inline" id="owner" value="{{$room->Owner->username}}"type="text" disabled>
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
          <div class="col-md-8 col-sm-12" id="operatorSlotList">

              @if ($room->battleplan != null)
                  @foreach ($room->battleplan->slots as $key => $slot)
                      {{-- <div class="text-center"> --}}
                          {{-- <button type="button" name="button" class="btn btn-primary col-{{floor(12/count($room->battleplan->slots))}} " onclick="app.engine.changeFloor(1)">Floor &uarr;</button> --}}

                              {{-- {{dd($slot->operator)}} --}}
                      @if ($room->Owner == Auth::User())
                          @if (!$slot->operator || !$slot->operator->exists)
                                  <input type="image" id="operatorSlot-{{$slot->id}}" data-id="{{$slot->id}}" src="/media/ops/empty.png" class="op-icon operator-slot operator-border" data-toggle="modal" data-target="#opModal" onclick="setEditingOperatorSlot($(this).data('id'))" style="border-color: black" />
                          @else
                                  <input type="image" id="operatorSlot-{{$slot->id}}" data-id="{{$slot->id}}" src="{{$slot->operator->icon}}" class="op-icon operator-slot operator-border" data-toggle="modal" data-target="#opModal" onclick="setEditingOperatorSlot($(this).data('id'))" style="border-color: #{{$slot->operator->colour}}"/>
                          @endif
                      @else
                          @if (!$slot->operator || !$slot->operator->exists)
                                  <input type="image" id="operatorSlot-{{$slot->id}}" data-id="{{$slot->id}}" src="/media/ops/empty.png" class="op-icon operator-slot operator-border" style="border-color: black" />
                          @else
                                  <input type="image" id="operatorSlot-{{$slot->id}}" data-id="{{$slot->id}}" src="{{$slot->operator->icon}}" class="op-icon operator-slot operator-border" style="border-color: #{{$slot->operator->colour}}"/>
                          @endif
                      @endif

                        {{-- @if (!$slot->operator->exists)
                                <input type="image" id="operatorSlot-{{$slot->id}}" src="/media/ops/empty.png" class="op-icon operator-border" data-toggle="modal" data-target="#opModal" onclick="setEditingOperatorSlot({{$slot->id}})" style="border-color: black" />
                        @else
                                <input type="image" id="operatorSlot-{{$slot->id}}" src="{{$slot->operator->icon}}" class="op-icon operator-border" data-toggle="modal" data-target="#opModal" onclick="setEditingOperatorSlot({{$slot->id}})" style="border-color: #{{$slot->operator->colour}}"/>
                        @endif --}}
                        {{-- </div> --}}
                  @endforeach
              @endif
          </div>

          <div class="col-md-3 col-sm-12 text-center">
              {{-- Functionality --}}
              <div class="row">
                   <div class="col-md-9 col-sm-12">
                       <div class="row mt-2">
                           @if ($room->Owner == Auth::User())
                             <button type="button" name="button" class="btn btn-info col-6" data-toggle="modal" data-target="#mapModal">Load</button>
                             <button type="button" name="button" class="btn btn-success col-6" onclick="app.engine.save()">Save</button>
                           @endif
                       </div>
                       <div class="row mt-1">
                           <button type="button" name="button" class="btn btn-primary col-6" onclick="app.engine.changeFloor(-1)">Floor &darr;</button>
                           <button type="button" name="button" class="btn btn-primary col-6" onclick="app.engine.changeFloor(1)">Floor &uarr;</button>
                       </div>
                   </div>
                   <div class="col-md-3 col-sm-12 text-center mt-2">
                       {{-- <p style="color:white;">Pencil</p> --}}
                       <input type="color" id='colorPicker' id="head" name="color" value="#e66465" onChange="app.engine.changeColor(this.value)" />
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
                  <textarea class="form-control battleplan_notes" id="comment"></textarea>
              @else
                  <textarea class="form-control battleplan_notes" id="comment" disabled></textarea>
              @endif
          {{-- </div> --}}
      </div>
  </div>
</div>

{{-- Help --}}
<div class="collapse " id="room_help">
  <div class="card card-body bg-dark m-0 p-0">

      <div class="row text-center">
          <div class="col-12" style="color:white">
              <h1>Ooops! Looks like I have not made it this far yet!</h1>
          </div>
      </div>
  </div>
</div>

@push('js')
    <script type="text/javascript">
        function setEditingOperatorSlot(id){
            $("#EditingOperatorSlot").val(id);
        }
    </script>
@endpush
