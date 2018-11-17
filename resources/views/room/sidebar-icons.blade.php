{{-- @foreach ($gadgets as $key => $gadget)
    <img src="{{$gadget->icon}}" draggable="true" ondragstart="app.engine.drag(event)"  alt="" height="50px" width="50px">
@endforeach --}}
<input type="text" id="myInput" class="col-12" onkeyup="search()" placeholder="Search by names..">

<ul id="iconList">
    @foreach ($gadgets as $key => $gadget)
      @if($gadget->icon)
        <li>
          <img src="{{$gadget->icon}}" draggable="true" ondragstart="app.engine.drag(event)"  alt="" height="50px" width="50px">
          <a href="#">{{$gadget->name}}</a>
        </li>
      @endif
    @endforeach
</ul>

@push('js')
  <script>
    function search() {
        // Declare variables
        var input, filter, ul, li, a, i;
        input = document.getElementById('myInput');
        filter = input.value.toUpperCase();
        ul = document.getElementById("iconList");
        li = ul.getElementsByTagName('li');
    
        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
    </script>
@endpush