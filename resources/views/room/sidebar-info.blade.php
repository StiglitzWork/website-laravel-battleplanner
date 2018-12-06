<div class="row margin10">
    <div class="col-4">
        <label class="inline connection" for="connection">Room #:</label>
    </div>
    <div class="col-8">
        <input class="col-4 form-control inline col-12" id="connection" value="5bf35db282ec2" type="text" disabled="">
    </div>
</div>

<div class="row margin10">
    <div class="col-4">
        <label class="inline connection" for="connection">Owner :</label>
    </div>
    <div class="col-8">
        <input class="col-4 form-control inline col-12" id="owner" value="admin" type="text" disabled="">
    </div>
</div>
<div class="row margin10">
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
