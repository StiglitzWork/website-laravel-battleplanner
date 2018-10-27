<div class="competitive">
  <h1>
    <strong><center>Saved Maps</center></strong>
  </h1>
</div>
<div class="row text-center">
    <div class="col-12">
        <ul class="list-group">
          @foreach($battleplans as $battleplan)
            <li class="list-group-item">{{$battleplan->name}}</li>
          @endforeach
        </ul>
    </div>
</div>
