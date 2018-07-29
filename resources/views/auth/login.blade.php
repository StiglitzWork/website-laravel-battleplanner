@extends('layouts.main')

@push('css')
  <link rel="stylesheet" href="{{r_asset("css/login/login.css")}}">
@endpush

@section('content')
<div class="form">

  {{-- Login --}}
  <form class="login-form" method="POST" action="{{ route('login') }}" >
    @csrf
    <input placeholder="username" id="username" type="username" value="kriegersmith" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>

    @if ($errors->has('username'))
      <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('username') }}</strong>
      </span>
    @endif

    <input  placeholder="password" id="password" type="password" value="thisisapassword123" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

    @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif

    <button>login</button>
    <p class="message">Not registered? <a href="/register">Create an account</a></p>
  </form>

</div>
@endsection
