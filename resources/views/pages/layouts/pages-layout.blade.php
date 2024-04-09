<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="{{ config('app.name') }}">
    <meta name="keywords" content="{{ config('app.name') }}">
    <meta name="author" content="{{ config('app.name') }}">
    <title>{{ config('app.name') }} | {{ $title }}</title>

    <!-- begin:: icon -->
    <link rel="apple-touch-icon" href="{{ asset_admin('images/icon/apple-touch-icon.png') }}" sizes="180x180" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon-32x32.png') }}" type="image/x-icon" sizes="32x32" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon-16x16.png') }}" type="image/x-icon" sizes="16x16" />
    <link rel="icon" href="{{ asset_admin('images/icon/favicon.ico') }}" type="image/x-icon" />
    <!-- end:: icon -->

    <!-- begin:: css global -->
    <link href="{{ asset_pages('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset_pages('css/bootstrap-icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset_pages('css/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset_pages('css/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset_pages('css/owl.carousel.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset_pages('css/odometer.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset_pages('css/spacing.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset_pages('css/base.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset_pages('css/shortcodes.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset_pages('css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset_pages('css/responsive.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset_pages('css/theme-color/color-2.css') }}" rel="stylesheet" data-style="styles" />
    <link href="{{ asset_pages('css/color-customize/color-customizer.css') }}" rel="stylesheet" type="text/css" />
    <!-- end:: css global -->

    <!-- begin:: css local -->
    @stack('css')
    <!-- end:: css local -->
</head>

<body>
    <div class="page-wrapper">
        <!-- begin:: preloader -->
        <div id="ht-preloader">
            <div class="loader clear-loader">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <div class="loader-text">Loading</div>
            </div>
        </div>
        <!-- end:: preloader -->

        <!-- begin:: navbar -->
        <x-pages-navbar />
        <!-- end:: navbar -->

        <!-- begin:: body -->
        {{ $slot }}
        <!-- end:: body -->

        <!-- begin:: footer -->
        <x-pages-footer />
        <!-- end:: footer -->
    </div>

    <!-- begin:: color-customizer -->
    <div class="color-customizer closed">
        <a class="opener" href="#"> <i class="bi bi-palette"></i></a>
        <div class="clearfix color-chooser text-center">
            <h4 class="mb-4">Soften With Awesome Colors</h4>
            <ul class="colorChange clearfix">
                <li class="theme-default" title="theme-default" data-style="color-1"></li>
                <li class="theme-2 selected" title="theme-2" data-style="color-2"></li>
                <li class="theme-3" title="theme-3" data-style="color-3"></li>
                <li class="theme-4" title="theme-4" data-style="color-4"></li>
                <li class="theme-5" title="theme-5" data-style="color-5"></li>
                <li class="theme-6" title="theme-6" data-style="color-6"></li>
                <li class="theme-7" title="theme-7" data-style="color-7"></li>
                <li class="theme-8" title="theme-8" data-style="color-8"></li>
                <li class="theme-9" title="theme-9" data-style="color-9"></li>
                <li class="theme-10" title="theme-10" data-style="color-10"></li>
                <li class="theme-11" title="theme-11" data-style="color-11"></li>
                <li class="theme-12" title="theme-12" data-style="color-12"></li>
            </ul>
            <div class="text-center mt-4">
                <a class="themeht-btn" href="#">Purchase Now</a>
            </div>
        </div>
    </div>
    <!-- end:: color-customizer -->

    <!-- begin:: back-to-top -->
    <div class="scroll-top">
        <svg class="scroll-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- end:: back-to-top -->

    <!-- begin:: js global -->
    <script src="{{ asset_pages('js/jquery.min.js') }}"></script>
    <script src="{{ asset_pages('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset_pages('js/jquery-appear.js') }}"></script>
    <script src="{{ asset_pages('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset_pages('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset_pages('js/odometer.min.js') }}"></script>
    <script src="{{ asset_pages('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset_pages('js/wow.min.js') }}"></script>
    <script src="{{ asset_pages('js/color-customize/color-customizer.js') }}"></script>
    <script src="{{ asset_pages('js/theme-script.js') }}"></script>
    <!-- end:: js global -->

    <!-- begin:: js local -->
    @stack('js')
    <!-- end:: js local -->
</body>

</html>