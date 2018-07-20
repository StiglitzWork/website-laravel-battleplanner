<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark  .sticky-top">
  <a class="navbar-brand" href="/">R6 Map Planner</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      @auth
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="/home">Home</a>
        </li>
      @endauth
      @guest
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="/login">login</a>
        </li>

        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="/register">register</a>
        </li>
      @endguest
  </div>
</nav>
{{--
  <nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="/">R6 Map Planner</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          @auth
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="/home">Home</a>
            </li>
          @endauth
          @guest
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="/login">login</a>
            </li>

            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="/register">register</a>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav> --}}
