@extends('layouts.main')

@section('content')
    <p id="power">0</p>
@endsection

@push ('js')
    {{-- <script src="{{ asset('js/socket.io.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js" charset="utf-8"></script>
    <script>
        // require('socket.io')
        // var socket = io('http://localhost:3000');
        var socket = io('http://r6.local:3000');
        socket.on("test-channel:App\\Events\\EventTesting", function(message){
            // increase the power everytime we load test route
            $('#power').text(parseInt($('#power').text()) + parseInt(message.data.power));
        });
    </script>
@endpush
