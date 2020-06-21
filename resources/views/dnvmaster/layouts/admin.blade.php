<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>{{ $title or 'DnvMaster' }}</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="{{ asset(env('MASTER')) }}/img/logos/logo-shortcut.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ asset(env('MASTER')) }}/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset(env('MASTER')) }}/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="{{ asset(env('MASTER')) }}/css/icomoon.css">
        <link rel="stylesheet" href="{{ asset(env('MASTER')) }}/css/animate.css">
        <link rel="stylesheet" href="{{ asset(env('MASTER')) }}/css/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="{{ asset(env('MASTER')) }}/css/default.css">
        <link rel="stylesheet" type="text/css" href="{{ asset(env('MASTER')) }}/css/styles.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900&amp;subset=latin-ext,vietnamese" rel="stylesheet">
    </head>
    <body>
        @yield('topBar')
        @yield('navigation')
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="container" style="margin-top: 100px; margin-bottom: 100px;">
            <div class="row-{{ isset($bar) ? $bar : 'no' }}">
                @yield('content')
                @yield('bar')
            </div>
        </div>
        @yield('footer')
        <a href="#" class="scroll-to-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
        <script src="{{ asset(env('MASTER')) }}/js/jquery.min.js"></script>
        <script src="{{ asset(env('MASTER')) }}/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="{{ asset(env('MASTER')) }}/js/ckeditor/ckeditor.js"></script>
        <script src="{{ asset(env('MASTER')) }}/js/bootstrap-filestyle.min.js"></script>
    </body>
</html>