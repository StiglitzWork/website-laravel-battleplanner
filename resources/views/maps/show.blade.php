@extends('layouts.main')

@push('js')
  <!-- <script src="{{asset("js/index/index.js")}}"></script> -->
@endpush

@push('css')
  <link rel="stylesheet" href="{{r_asset("css/index/index.css")}}">
@endpush

@section('content')
  <img src="/{{$map->floors()->first()->src}}">
@endsection
