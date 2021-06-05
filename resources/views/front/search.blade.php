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

  <section class="section mb-5 pb-2" style="margin-top: 150px;">
    <div class="container">
      <div class="section-title mt-3 mb-4">
        <h5>Search Result</h5>
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
