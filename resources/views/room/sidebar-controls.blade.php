
@if ($room->Owner == Auth::User())
    <div class="row">
        <div class="col-6">
                <button type="button" name="button" class="btn btn-info col-12" data-toggle="modal"
                    data-target="#mapModal">Load</button>
        </div>
        <div class="col-6">
                <button type="button" name="button" class="btn btn-success col-12" onclick="app.engine.save()">Save</button>
        </div>
    </div>
@endif
<div class="row">
        <div class="col-6">

            <button type="button" name="button" class="btn btn-primary col-12" onclick="app.engine.changeFloor(-1)" data-toggle="tooltip" data-placement="top" title="Keybind: Down arrow">Floor
                &darr;</button>
        </div>
        <div class="col-6">
                <button type="button" name="button" class="btn btn-primary col-12" onclick="app.engine.changeFloor(1)" data-toggle="tooltip" data-placement="top" title="Keybind: Up arrow">Floor
                    &uarr;</button>
        </div>
</div>

<div class="row">
    <div class="col-12">
        <input type="color" class="col-12" id='colorPicker' name="color" value="#e66465" onChange="app.engine.changeColor(this.value)" />
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-4">Pen size</div>
            <input type="number" id='lineSizePicker'  class="col-8" name="size" onChange="app.engine.changeLineSize(this.value)" />
        </div>
        <div class="row">
                <div class="col-4">Icon size</div>
                <input type="number" id='iconSizePicker'  class="col-8" name="size" onChange="app.engine.changeIconSize(this.value)" />
        </div>
    </div>
</div>
