
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
                
            <button type="button" name="button" class="btn btn-primary col-12" onclick="app.engine.changeFloor(-1)">Floor
                &darr;</button>
        </div>
        <div class="col-6">
                <button type="button" name="button" class="btn btn-primary col-12" onclick="app.engine.changeFloor(1)">Floor
                    &uarr;</button>
        </div>
</div>

<div class="row">
    <div class="col-6">
        <label for="color">color</label><br>
        <input type="color" id='colorPicker' name="color" value="#e66465" onChange="app.engine.changeColor(this.value)" />
    </div>
    <div class="col-6">
        <label for="color">Pen Size</label>
        <input type="number" id='sizePicker' name="size" onChange="app.engine.changeSize(this.value)" />
    </div>
</div>