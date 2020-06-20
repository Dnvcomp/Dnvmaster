<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="description" content="{{ (isset($description)) ? $description : '' }}">
    <meta name="keywords" content="{{ (isset($keywords)) ? $keywords : '' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title or 'DnvMaster' }}</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset(env('MASTER')) }}/img/logos/logo-shortcut.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset(env('MASTER')) }}/css/bootstrap.min.css">
    <!-- Font-Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset(env('MASTER')) }}/css/font-awesome.css">
    <!-- Icomoon -->
    <link rel="stylesheet" type="text/css" href="{{ asset(env('MASTER')) }}/css/icomoon.css">
    <!-- Pogo Slider -->
    <link rel="stylesheet" href="{{ asset(env('MASTER')) }}/css/pogo-slider.min.css">
    <link rel="stylesheet" href="{{ asset(env('MASTER')) }}/css/slider.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="{{ asset(env('MASTER')) }}/css/animate.css">
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{ asset(env('MASTER')) }}/css/owl.carousel.css">
    <!-- Main Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset(env('MASTER')) }}/css/default.css">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('MASTER')) }}/css/styles.css">
    <!-- Fonts Google -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900&amp;subset=latin-ext,vietnamese" rel="stylesheet">
</head>
<body>
    <!-- Preloader Start-->
    <div id="preloader">
        <div class="row loader">
            <div class="loader-icon"></div>
        </div>
    </div>
    <!-- Preloader End -->
    <!-- Top-Bar START -->
    @yield('topBar')
    <!-- Top-Bar END -->
    <!-- Navbar START -->
   @yield('navigation')
    <!-- Navbar END -->
    <div class="wrap_result"></div>
    <!-- Slider START -->
    @yield('sliders')
    <!-- Slider END -->
    <!-- Blog Post START -->
    <div class="container" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="row-{{ isset($bar) ? $bar : 'no' }}">
            @yield('content')
            @yield('bar')
        </div>
    </div>
    <!-- Blog Post END -->
    <!-- Partners Section START -->
    @yield('partner')
    <!-- Partners Section END -->
    <!-- Footer START -->
    @yield('footer')
    <!-- Footer END -->
    <!-- Scroll to top button Start -->
    <a href="#" class="scroll-to-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
    <!-- Scroll to top button End -->
    <!-- Jquery -->
    <script src="{{ asset(env('MASTER')) }}/js/jquery.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset(env('MASTER')) }}/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Pogo Slider -->
    <script src="{{ asset(env('MASTER')) }}/js/jquery.pogo-slider.min.js"></script>
    <script src="{{ asset(env('MASTER')) }}/js/pogo-main.js"></script>
    <!-- Owl Carousel-->
    <script src="{{ asset(env('MASTER')) }}/js/owl.carousel.js"></script>
    <!-- Wow JS -->
    <script type="text/javascript" src="{{ asset(env('MASTER')) }}/js/wow.min.js"></script>
    <!-- Countup -->
    <script src="{{ asset(env('MASTER')) }}/js/jquery.counterup.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <!-- Isotop -->
    <script type="text/javascript" src="{{ asset(env('MASTER')) }}/js/isotope.pkgd.min.js"></script>
    <!-- Tabs -->
    <script type="text/javascript" src="{{ asset(env('MASTER')) }}/js/tabs.min.js"></script>
    <!-- Modernizr -->
    <script src="{{ asset(env('MASTER')) }}/js/modernizr.js"></script>
    <!-- Main JS -->
    <script src="{{ asset(env('MASTER')) }}/js/main.js"></script>
    <script src="{{ asset(env('MASTER')) }}/js/comment-reply.js"></script>
    <script src="{{ asset(env('MASTER')) }}/js/my-comments.js"></script>
</body>
</html>