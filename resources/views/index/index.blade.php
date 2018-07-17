@extends('layouts.main')

@push('js')
  <script src="{{asset("js/index/index.js")}}"></script>
@endpush

@push('css')
  <link rel="stylesheet" href="{{asset("css/index/index.css")}}">
@endpush

@section('content')

    <header class="masthead text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <strong>Plan Your Victory</strong>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-faded mb-5">Make the difference</p>
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="/map">Map Planner</a>
          </div>
        </div>
      </div>
    </header>

    <section class="bg-primary" id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">We've got what you need!</h2>
            <hr class="light my-4">
            <p class="text-faded mb-4">Don't get caught in the action without your game plan.</p>
            <p class="text-faded mb-4">All Rights to Rainbow 6: Siege are property of Ubisoft. This is a non-profit, fan made website.</p>
            <p class="text-faded mb-4">For more information contact erik.aaron.smith@gmail.com</p>
            <a class="btn btn-light btn-xl js-scroll-trigger" href="/map">Get Started!</a>
          </div>
        </div>
      </div>
    </section>


@endsection
