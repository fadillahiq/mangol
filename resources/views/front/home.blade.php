<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>Mangol</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-grad-school.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flexbox.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/manga.css') }}">

<!--

TemplateMo 557 Grad School

https://templatemo.com/tm-557-grad-school

-->
  </head>

<body>


  <!--header-->
  @include('layouts.header')

  <section class="section courses pb-4 p-3">
    <div class="container">
      <div class="row">

        <div class="section-title mt-5 pt-5">
            <h5>Completed</h5>
        </div>
        <div class="section-title mt-5 pt-5 ml-auto">
            <a class="btn btn-warning btn-sm text-dark" href="{{ route('mangol.complete') }}">More...</a>
        </div>
        <div class="owl-carousel owl-theme mt-4">
          @foreach ($completes->take(5) as $complete)
            <div class="item">
                <a href="{{ route('mangol.detail', $complete->id) }}">
                    <img src="{{ asset('storage/img/'.$complete->image) }}" class="img" alt="">
                </a>
                <div class="content mt-3">
                <a href="{{ route('mangol.detail', $complete->id) }}"><h6 class="text-center">{{ $complete->title }}</h6></a>
                </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
  <section class="section mb-5 pb-2">
    <div class="container">
      <div class="section-title mt-3 mb-4">
        <h5>Chapter Terbaru</h5>
      </div>
      <!-- Flex -->
      <div class="flexbox3">
        @foreach ($comics as $comic)
        <div class="flexbox3-item">

          <div class="flexbox3-content">
            <a href="{{ route('mangol.detail', $comic->id) }}">
              <div class="flexbox3-thumb">
                <img src="{{ asset('storage/img/'.$comic->image) }}" class="img-fluid" alt="">
              </div>
            </a>
            <div class="flexbox3-side">
              <div>
                <a href="{{ route('mangol.detail', $comic->id) }}">{{ $comic->title }}</a>
              </div>
              <ul class="chapter">
                @foreach ($comic->chapters()->take(3)->orderBy('created_at', 'desc')->get() as $new)
                <li>
                    <a href="{{ route('mangol.chapter', $new->id) }}">{{ $new->title }}</a>
                      <span class="date">{{ \Carbon\Carbon::parse($new->created_at)->diffForHumans() }}</span>
                </li>
                @endforeach
              </ul>
            </div>
          </div>

        </div>
        @endforeach
      </div>
  <!-- End Flex -->
    </div>
  </section>

  @include('layouts.footer')



  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></>
    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
