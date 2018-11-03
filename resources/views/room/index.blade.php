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

          <h5>Rooms are used to create battleplans. Any number of people can
              be connected to a single Room and any changes the Room's owner
              makes will appear for everyone else, allowing fluid planning and
              easy switching between all of your saved battleplans.</h5>
        </div>
      </div>
      <div class="row mt-4">

        <div class="col-6">
          <a href="/room/create" type="button" class="col-6 btn btn-primary">Create a new Room</a>
        </div>

        <div class="col-6">
          <a  href="/room/join" type="button" class="col-6 btn btn-success">Join by Room ID</a>
        </div>

      </div>
    </div>
@endsection
