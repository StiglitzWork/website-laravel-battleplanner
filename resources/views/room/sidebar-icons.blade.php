<h2>Secondary gadgets:</h2>
@foreach ($gadgets as $key => $gadget)
  @if(!$gadget->prime && !$gadget->general)
    <img src="{{$gadget->icon}}" draggable="true" ondragstart="app.engine.drag(event)"  alt="" height="50px" width="50px">
    @endif
@endforeach

<h2>General tools:</h2>
@foreach ($gadgets as $key => $gadget)
  @if(!$gadget->prime && $gadget->general)
    <img src="{{$gadget->icon}}" draggable="true" ondragstart="app.engine.drag(event)"  alt="" height="50px" width="50px">
    @endif
@endforeach
