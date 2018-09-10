@extends('layouts.main')

@push('js')
  <script src="{{r_asset("js/room/index.js")}}"></script>
@endpush

@push('css')
  <link rel="stylesheet" href="{{r_asset("css/room/index.css")}}">
@endpush

@section('content')
    <div class="jumbotron text-center">
      <div class="row">
        <div class="col-12 text-center">
          <h1>Room Options</h1>
        </div>
      </div>
      <div class="row mt-4">

        <div class="col-6">
          <a href="/room/new" type="button" class="col-6 btn btn-primary">New</a>
        </div>

        <div class="col-6">
          <a  href="/room/join" type="button" class="col-6 btn btn-success">join</a>
        </div>

      </div>
    </div>
@endsection
