<div class="row">
    <div class="col-4">
            <label class="inline connection" for="connection">Room #:</label>
    </div>
    <div class="col-8">
        <input class="col-4 form-control inline col-12" id="connection" value="{{$room->connection_string}}" type="text"
            disabled>
    </div>
</div>

<div class="row">
    <div class="col-4">
            <label class="inline connection" for="connection">Owner :</label>
    </div>
    <div class="col-8">
        <input class="col-4 form-control inline col-12" id="owner" value="{{$room->Owner->username}}" type="text"
            disabled>
    </div>
</div>
<div class="row">
    <div class="col-4">
            <label class="inline connection" for="connection">Name :</label>
    </div>
    <div class="col-8">
        @if ($room->Owner == Auth::User())
            <input class="col-4 form-control inline col-12" id="battleplan_name" value="" type="text">
        @else
            <input class="col-4 form-control inline col-12" id="battleplan_name" value="" type="text" disabled>
        @endif
    </div>
</div>