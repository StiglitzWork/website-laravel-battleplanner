<div class="competitive">
  <h1>
    <strong><center>Saved Maps</center></strong>
  </h1>
</div>
<div class="row">
    <div class="col-12">
        <ul class="list-group savedBattleplan-list">
          @foreach($battleplans as $battleplan)
            <li class="list-group-item" href="#" onclick="app.engine.loadBattlePlan({{$battleplan->id}})">
                <div class="col-12">
                    (<strong>{{ucwords($battleplan->map->name)}}</strong>) {{$battleplan->name}}
                </div>
                <div class="col-12 text-right">
                    <button type="button" class="btn btn-danger" onclick="app.engine.deleteBattlePlan({{$battleplan->id}})">Delete</button>
                </div>
            </li>
          @endforeach
        </ul>
    </div>
</div>

@push('css')
    <style>
         .savedBattleplan-list > .list-group-item{
             cursor: pointer;
         }
     </style>
@endpush
