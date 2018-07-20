@extends('layouts.main')

@push('js')
  <!-- <script src="{{asset("js/index/index.js")}}"></script> -->
@endpush

@push('css')
  <link rel="stylesheet" href="{{asset("css/index/index.css")}}">
@endpush

@section('content')
  {{dd($map->floors)}}
@endsection
