<div class="competitive">
  <h1>
    <strong><center>Ranked Maps</center></strong>
  </h1>
</div>
<div class="row text-center">
  @foreach($maps as $map)
    @if($map->comp)
      <div class="col-6">
        <a onclick="app.engine.newBattlePlan({{$map->id}})" class="text-center">
          <div class="container text-center map-container">
            <img src="{{$map->thumbsrc}}" class="map-thumb">
            <div class="map-name stroke-text">
              {{ucwords($map->name)}}
            </div>
          </div>
        </a>
      </div>
    @endif
  @endforeach
</div>

</br></br>

<div class="casual">
  <h1>
    <strong><center>Casual Maps</center></strong>
  </h1>
</div>
<div class="row text-center">
  @foreach($maps as $map)
    @if(!$map->comp)
      <div class="col-6">
        <a onclick="app.engine.newBattlePlan({{$map->id}})" class="text-center">
          <div class="container text-center map-container">
            <img src="{{$map->thumbsrc}}" class="map-thumb">
            <div class="map-name stroke-text">
              {{ucwords($map->name)}}
            </div>
          </div>
        </a>
      </div>
    @endif
  @endforeach
</div>