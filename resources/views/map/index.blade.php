@extends('layouts.main')

@push('js')
  <!-- <script src="{{asset("js/index/index.js")}}"></script> -->
@endpush

@push('css')
  <!-- <link rel="stylesheet" href="{{asset("css/index/index.css")}}"> -->
@endpush

@section('content')
  @foreach($maps as $map)

    <div class="card" style="width: 18rem;">
      <h2>
        {{$map->name}}
      </h2>
      <img class="card-img-top" src="{{$map->thumbsrc}}">
    </div>
  @endforeach
@endsection
