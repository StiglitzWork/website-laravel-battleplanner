<div class="row text-center">
  @foreach($atk_operators as $operator)
    @if($operator)
      <div class="col-md-3 col-xs-12 top-buffer cursor-click">
          <div class="container text-center map-container">
            <img src="{{$operator->icon}}" class="map-thumb">
            <div class="map-name stroke-text">
              {{ucwords($operator->name)}}
            </div>
          </div>
      </div>
    @endif
  @endforeach
</div>
