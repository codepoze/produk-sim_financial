<!doctype html>
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
    <link href="{{ asset_admin('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset_admin('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset_admin('css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset_admin('libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset_admin('my_assets/my_css.css') }}" rel="stylesheet" type="text/css" />
    <!-- end:: css global -->

    <script type="text/javascript" src="{{ asset_admin('libs/jquery/jquery.min.js') }}"></script>

    <!-- begin:: css local -->
    @stack('css')
    <!-- end:: css local -->
</head>

<body data-sidebar="dark" data-layout-mode="light">
    <div id="layout-wrapper">
        <!-- begin:: navbar -->
        <x-admin-navbar />
        <!-- end:: navbar -->

        <!-- begin:: sidebar -->
        <x-admin-sidebar />
        <!-- end:: sidebar -->

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- begin:: breadcumb -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">{{ $title }}</h4>
                                <div class="page-title-right">
                                    {!! $breadcrumb !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end:: breadcumb -->

                    <!-- begin:: body -->
                    {{ $slot }}
                    <!-- end:: body -->
                </div>
            </div>

            <!-- begin:: footer -->
            <x-admin-footer />
            <!-- end:: footer -->
        </div>
    </div>

    <div class="rightbar-overlay"></div>

    <!-- begin:: js global -->
    <script type="text/javascript" src="{{ asset_admin('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('libs/metismenu/metisMenu.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('libs/simplebar/simplebar.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('libs/node-waves/waves.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('my_assets/parsley/2.9.2/parsley.js') }}"></script>
    <script type="text/javascript" src="{{ asset_admin('my_assets/my_fun.js') }}"></script>
    <script>
        ! function(e) {
            "use strict";
            var t, a = localStorage.getItem("language");

            function s(t) {
                document.getElementById("header-lang-img") && ("en" == t ? document.getElementById("header-lang-img").src = "assets/admin/images/flags/us.jpg" : "sp" == t ? document.getElementById("header-lang-img").src = "assets/admin/images/flags/spain.jpg" : "gr" == t ? document.getElementById("header-lang-img").src = "assets/admin/images/flags/germany.jpg" : "it" == t ? document.getElementById("header-lang-img").src = "assets/admin/images/flags/italy.jpg" : "ru" == t && (document.getElementById("header-lang-img").src = "assets/admin/images/flags/russia.jpg"), localStorage.setItem("language", t), null == (a = localStorage.getItem("language")) && s("en"), e.getJSON("assets/admin/lang/" + a + ".json", (function(t) {
                    e("html").attr("lang", a), e.each(t, (function(t, a) {
                        "head" === t && e(document).attr("title", a.title), e("[key='" + t + "']").text(a)
                    }))
                })))
            }

            function n() {
                for (var e = document.getElementById("topnav-menu-content").getElementsByTagName("a"), t = 0, a = e.length; t < a; t++) "nav-item dropdown active" === e[t].parentElement.getAttribute("class") && (e[t].parentElement.classList.remove("active"), null !== e[t].nextElementSibling && e[t].nextElementSibling.classList.remove("show"))
            }

            function c(t) {
                1 == e("#light-mode-switch").prop("checked") && "light-mode-switch" === t ? (e("html").removeAttr("dir"), e("#dark-mode-switch").prop("checked", !1), e("#rtl-mode-switch").prop("checked", !1), e("#dark-rtl-mode-switch").prop("checked", !1), e("#bootstrap-style").attr("href", "{{ asset_admin('css/bootstrap.min.css') }}"), e("body").attr("data-layout-mode", "light"), e("#app-style").attr("href", "{{ asset_admin('css/app.min.css') }}"), sessionStorage.setItem("is_visited", "light-mode-switch")) : 1 == e("#dark-mode-switch").prop("checked") && "dark-mode-switch" === t ? (e("html").removeAttr("dir"), e("#light-mode-switch").prop("checked", !1), e("#rtl-mode-switch").prop("checked", !1), e("#dark-rtl-mode-switch").prop("checked", !1), e("body").attr("data-layout-mode", "dark"), sessionStorage.setItem("is_visited", "dark-mode-switch")) : 1 == e("#rtl-mode-switch").prop("checked") && "rtl-mode-switch" === t ? (e("#light-mode-switch").prop("checked", !1), e("#dark-mode-switch").prop("checked", !1), e("#dark-rtl-mode-switch").prop("checked", !1), e("#bootstrap-style").attr("href", "assets/admin/css/bootstrap-rtl.min.css"), e("#app-style").attr("href", "assets/admin/css/app-rtl.min.css"), e("html").attr("dir", "rtl"), e("body").attr("data-layout-mode", "light"), sessionStorage.setItem("is_visited", "rtl-mode-switch")) : 1 == e("#dark-rtl-mode-switch").prop("checked") && "dark-rtl-mode-switch" === t && (e("#light-mode-switch").prop("checked", !1), e("#rtl-mode-switch").prop("checked", !1), e("#dark-mode-switch").prop("checked", !1), e("#bootstrap-style").attr("href", "assets/admin/css/bootstrap-rtl.min.css"), e("#app-style").attr("href", "assets/admin/css/app-rtl.min.css"), e("html").attr("dir", "rtl"), e("body").attr("data-layout-mode", "dark"), sessionStorage.setItem("is_visited", "dark-rtl-mode-switch"))
            }

            function r() {
                document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement || (console.log("pressed"), e("body").removeClass("fullscreen-enable"))
            }
            e("#side-menu").metisMenu(), e("#vertical-menu-btn").on("click", (function(t) {
                    t.preventDefault(), e("body").toggleClass("sidebar-enable"), 992 <= e(window).width() ? e("body").toggleClass("vertical-collpsed") : e("body").removeClass("vertical-collpsed")
                })), e("#sidebar-menu a").each((function() {
                    var t = window.location.href.split(/[?#]/)[0];
                    this.href == t && (e(this).addClass("active"), e(this).parent().addClass("mm-active"), e(this).parent().parent().addClass("mm-show"), e(this).parent().parent().prev().addClass("mm-active"), e(this).parent().parent().parent().addClass("mm-active"), e(this).parent().parent().parent().parent().addClass("mm-show"), e(this).parent().parent().parent().parent().parent().addClass("mm-active"))
                })), e(document).ready((function() {
                    var t;
                    0 < e("#sidebar-menu").length && 0 < e("#sidebar-menu .mm-active .active").length && 300 < (t = e("#sidebar-menu .mm-active .active").offset().top) && (t -= 300, e(".vertical-menu .simplebar-content-wrapper").animate({
                        scrollTop: t
                    }, "slow"))
                })), e(".navbar-nav a").each((function() {
                    var t = window.location.href.split(/[?#]/)[0];
                    this.href == t && (e(this).addClass("active"), e(this).parent().addClass("active"), e(this).parent().parent().addClass("active"), e(this).parent().parent().parent().addClass("active"), e(this).parent().parent().parent().parent().addClass("active"), e(this).parent().parent().parent().parent().parent().addClass("active"), e(this).parent().parent().parent().parent().parent().parent().addClass("active"))
                })), e('[data-bs-toggle="fullscreen"]').on("click", (function(t) {
                    t.preventDefault(), e("body").toggleClass("fullscreen-enable"), document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement ? document.cancelFullScreen ? document.cancelFullScreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitCancelFullScreen && document.webkitCancelFullScreen() : document.documentElement.requestFullscreen ? document.documentElement.requestFullscreen() : document.documentElement.mozRequestFullScreen ? document.documentElement.mozRequestFullScreen() : document.documentElement.webkitRequestFullscreen && document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT)
                })), document.addEventListener("fullscreenchange", r), document.addEventListener("webkitfullscreenchange", r), document.addEventListener("mozfullscreenchange", r), e(".right-bar-toggle").on("click", (function(t) {
                    e("body").toggleClass("right-bar-enabled")
                })), e(document).on("click", "body", (function(t) {
                    0 < e(t.target).closest(".right-bar-toggle, .right-bar").length || e("body").removeClass("right-bar-enabled")
                })),
                function() {
                    if (document.getElementById("topnav-menu-content")) {
                        for (var e = document.getElementById("topnav-menu-content").getElementsByTagName("a"), t = 0, a = e.length; t < a; t++) e[t].onclick = function(e) {
                            "#" === e.target.getAttribute("href") && (e.target.parentElement.classList.toggle("active"), e.target.nextElementSibling.classList.toggle("show"))
                        };
                        window.addEventListener("resize", n)
                    }
                }(), [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map((function(e) {
                    return new bootstrap.Tooltip(e)
                })), [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]')).map((function(e) {
                    return new bootstrap.Popover(e)
                })), [].slice.call(document.querySelectorAll(".offcanvas")).map((function(e) {
                    return new bootstrap.Offcanvas(e)
                })), window.sessionStorage && ((t = sessionStorage.getItem("is_visited")) ? (e(".right-bar input:checkbox").prop("checked", !1), e("#" + t).prop("checked", !0), c(t)) : "rtl" === e("html").attr("dir") && "dark" === e("body").attr("data-layout-mode") ? (e("#dark-rtl-mode-switch").prop("checked", !0), e("#light-mode-switch").prop("checked", !1), sessionStorage.setItem("is_visited", "dark-rtl-mode-switch"), c(t)) : "rtl" === e("html").attr("dir") ? (e("#rtl-mode-switch").prop("checked", !0), e("#light-mode-switch").prop("checked", !1), sessionStorage.setItem("is_visited", "rtl-mode-switch"), c(t)) : "dark" === e("body").attr("data-layout-mode") ? (e("#dark-mode-switch").prop("checked", !0), e("#light-mode-switch").prop("checked", !1), sessionStorage.setItem("is_visited", "dark-mode-switch"), c(t)) : sessionStorage.setItem("is_visited", "light-mode-switch")), e("#light-mode-switch, #dark-mode-switch, #rtl-mode-switch, #dark-rtl-mode-switch").on("change", (function(e) {
                    c(e.target.id)
                })), e("#password-addon").on("click", (function() {
                    0 < e(this).siblings("input").length && ("password" == e(this).siblings("input").attr("type") ? e(this).siblings("input").attr("type", "input") : e(this).siblings("input").attr("type", "password"))
                })), null != a && "en" !== a && s(a), e(".language").on("click", (function(t) {
                    s(e(this).attr("data-lang"))
                })), Waves.init(), e("#checkAll").on("change", (function() {
                    e(".table-check .form-check-input").prop("checked", e(this).prop("checked"))
                })), e(".table-check .form-check-input").change((function() {
                    e(".table-check .form-check-input:checked").length == e(".table-check .form-check-input").length ? e("#checkAll").prop("checked", !0) : e("#checkAll").prop("checked", !1)
                }))
        }(jQuery);
    </script>
    <!-- end:: js global -->

    <!-- begin:: js local -->
    @stack('js')
    <!-- end:: js local -->
</body>

</html>