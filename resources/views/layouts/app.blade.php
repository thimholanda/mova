<!doctype html>
<html class="no-js" lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Ziit Business | @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }} ">

        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
        <script src="{{ asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>
    <body>

    <header class="zb-suport-header">
        <h1><span>Ziit Business</span></h1>
        <nav>
            <ul>
                <li><a href="/" title="HOME">IR PARA HOME</a></li>
            </ul>
        </nav>
    </header>

    <header class="zb-mobile-header">
        <h1><span>Ziit Business</span></h1>
        <button type="button" class="zb-btn-menu-mobile">
            <i class="fa fa-bars" aria-hidden="true"></i>
            <i class="fa fa-close" style="display: none;" aria-hidden="true"></i>
        </button>
    </header>

    <nav class="zb-nav-mobile">
        <ul>
            <li><a href="/" title="HOME">IR PARA HOME</a></li>
        </ul>
    </nav>

    @yield('content')

    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfMWadtyuU9OiZBvjpTzYQn22YziNKyp4" async defer></script>
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('js/vendor/featherlight.js') }}"></script>
    <script src="{{ asset('js/vendor/slick-animation.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
