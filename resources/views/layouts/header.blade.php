<header class="main-header" role="header" style="background-color:#070720;position:absolute;">
    <div class="container p-0">
      <div class="logo p-0">
        <a href="{{ route('mangol.index') }}"><em>Mangol</em></a>
      </div>
      <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
      <nav id="menu" class="main-nav" role="navigation">
        <ul class="main-menu p-0">
          <li><a href="{{ route('mangol.index') }}">Home</a></li>
          <li><a href="{{ route('mangol.all') }}">All Manga</a></li>
          <li>
          <form class="d-flex justify-content-center" action="{{ route('search') }}"  method="get">
              @csrf
              <input class="animatebar" type="search" placeholder="Search" name="search" aria-label="Search">
              <button class="btn btn-warning bordl" type="submit">
              <i class="fas fa-search"></i>
              </button>
          </form>
          </li>
        </ul>
      </nav>
    </div>
  </header>
