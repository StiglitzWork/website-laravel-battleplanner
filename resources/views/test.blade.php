@extends('layouts.main')


@section('content')
<div class="content">
    {{-- <div id="viewport">
        <canvas id="background" class="fixed"></canvas>
        <canvas id="overlay" class="fixed" onmouseleave="app.engine.canvasLeave(event)" onmouseenter="app.engine.canvasEnter(event)"
            onmousemove="app.engine.canvasMove(event)" onmousedown="app.engine.canvasDown(event)" onmouseup="app.engine.canvasUp(event)"
            onmousedown="app.engine.canvasDown(event)" ondrop="app.engine.canvasDrop(event)" ondragover="app.engine.allowDrop(event)">
        </canvas>
    </div> --}}
    <div class="toggletag toggled"><i class="fas fa-arrow-left fa-lg"></i></div>
    <div class="nav-side-menu toggled">
        <div class="brand">Options</div>

        <div class="menu-list">

            <ul id="menu-content" class="menu-content collapse out">
                


                {{-- Information --}}
                <li data-toggle="collapse" data-target="#info" class="collapsed active">
                    <a href="#"><i class="fas fa-info-circle"></i> Info </a>
                </li>

                <ul class="sub-menu collapse" id="info">
                    @include('room.sidebar-info')
                </ul>


                {{-- Controls --}}
                <li data-toggle="collapse" data-target="#controls" class="collapsed active">
                    <a href="#"> <i class="fas fa-sliders-h"></i> Controls</a>
                </li>

                <ul class="sub-menu collapse" id="controls">
                    <li class="active">Notes<a href="#">RFT-H1</a></li>
                    <li><a href="#">RFT-H2</a></li>
                    <li><a href="#">BTB-H1</a></li>
                    <li><a href="#">BTB-H2</a></li>
                </ul>

                {{-- notes --}}
                <li data-toggle="collapse" data-target="#notes" class="collapsed active">
                    <a href="#"><i class="fas fa-pen"></i> Notes</a>
                </li>

                <ul class="sub-menu collapse" id="notes">
                    <li class="active">Notes<a href="#">RFT-H1</a></li>
                    <li><a href="#">RFT-H2</a></li>
                    <li><a href="#">BTB-H1</a></li>
                    <li><a href="#">BTB-H2</a></li>
                </ul>

                {{-- Icons --}}
                <li data-toggle="collapse" data-target="#icons" class="collapsed active">
                    <a href="#"><i class="fas fa-image"></i> Icons</a>
                </li>

                <ul class="sub-menu collapse" id="icons">
                    <li class="active">Notes<a href="#">RFT-H1</a></li>
                    <li><a href="#">RFT-H2</a></li>
                    <li><a href="#">BTB-H1</a></li>
                    <li><a href="#">BTB-H2</a></li>
                </ul>

                {{-- Controls --}}
                <li data-toggle="collapse" class="collapsed active">
                    <a href="#"><i class="fas fa-image"></i> Help</a>
                </li>
    
            </ul>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{asset('js/room/sidebar.js')}})"></script>
@endpush


@push('css')
<style>
</style>
@endpush
