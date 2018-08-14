<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>BizPage Bootstrap Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="/img/favicon.png" rel="icon">
    <link href="/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>

<div id="root">

    <header id="header">
        <div class="container-fluid">

            <div id="logo" class="pull-left">
                <h1><a href="#">AutoCar</a></h1>
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    {{--<li class=""><a href="{{ route('root') }}">Home</a></li>--}}
                    <li><router-link to="/">Home</router-link></li>
                    <li><router-link to="/dashboard">Dashboard</router-link></li>
                    <li><router-link to="/dashboard-member">Dashboard</router-link></li>
                    <li><router-link to="/login">Login</router-link></li>
                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </header><!-- #header -->
    <router-view>

    </router-view>
    <footer id="footer">

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong>Danijel Djuric</strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="">Danijel Djuric</a>
            </div>
        </div>
    </footer><!-- #footer -->
</div>

{{-- <main id="main">
    @yield('content')
</main> --}}


<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

<!-- JavaScript Libraries -->
<script src="/lib/jquery/jquery.min.js"></script>
<script src="/lib/jquery/jquery-migrate.min.js"></script>
<script src="/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/lib/easing/easing.min.js"></script>
<script src="/lib/superfish/hoverIntent.js"></script>
<script src="/lib/superfish/superfish.min.js"></script>
<script src="/lib/wow/wow.min.js"></script>
<script src="/lib/waypoints/waypoints.min.js"></script>
<script src="/lib/counterup/counterup.min.js"></script>
<script src="/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="/lib/isotope/isotope.pkgd.min.js"></script>
<script src="/lib/lightbox/js/lightbox.min.js"></script>
<script src="/lib/touchSwipe/jquery.touchSwipe.min.js"></script>
<!-- Contact Form JavaScript File -->
<script src="/contactform/contactform.js"></script>

<!-- Template Main Javascript File -->
<script src="/js/main.js"></script>
{{--<script src="/lib/vue.js"></script>--}}
{{--<script src="/lib/vue-router.js"></script>--}}
{{--<script src="/vue/components/home.js"></script>--}}
{{--<script src="/vue/components/dashboard.js"></script>--}}
{{--<script src="/vue/components/login.js"></script>--}}
{{--<script src="/vue/main-app.js"></script>--}}
<script src="/js/app/js/app.js"></script>
</body>
</html>
