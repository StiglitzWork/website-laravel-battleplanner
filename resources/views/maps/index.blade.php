@extends('layouts.main')

@push('js')
  <!-- <script src="{{asset("js/index/index.js")}}"></script> -->
@endpush

@push('css')
  <link rel="stylesheet" href="{{asset("css/index/index.css")}}">
@endpush

@section('content')
  <div class="competitive">
    <h1>
      <strong><center>Competitive</center></strong>
    </h1>
  </div>
  <div class="row text-center">
    @foreach($maps as $map)
      @if($map->comp)
        <div class="col-md-3 col-xs-12 top-buffer">
          <div class="container">
            <a href="/maps/{{$map->name}}">
              <img src="{{$map->thumbsrc}}">
              <div class="top-left">
                {{ucwords($map->name)}}
              </div>
            </a>
          </div>
        </div>
      @endif
    @endforeach
  </div>

  </br></br>

  <div class="casual">
    <h1>
      <strong><center>Casual</center></strong>
    </h1>
  </div>
  <div class="row text-center">
    @foreach($maps as $map)
      @if(!$map->comp)
        <div class="col-xs-12 col-md-3 top-buffer">
          <div class="container">
            <a href="">
              <img src="{{$map->thumbsrc}}">
              <div class="top-left">
                {{ucwords($map->name)}}
              </div>
            </a>
          </div>
        </div>
      @endif
    @endforeach
  </div>
@endsection
