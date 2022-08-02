<!DOCTYPE html>

<html lang="en">

<head>

    <!-- Basic Page Needs
 ================================================== -->
    <meta charset="utf-8">
    <title>@yield('title', 'Unknown')</title>

    <!-- Mobile Specific Metas
 ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Themefisher Educenter HTML Template v1.0">

    <!-- ** Plugins Needed for the Project ** -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('frontend/plugins/bootstrap/bootstrap.min.css') }}">
    <!-- slick slider -->
    <link rel="stylesheet" href="{{ asset('frontend/plugins/slick/slick.css') }}">
    <!-- themefy-icon -->
    <link rel="stylesheet" href="{{ asset('frontend/plugins/themify-icons/themify-icons.css') }}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{ asset('frontend/plugins/animate/animate.css') }}">
    <!-- aos -->
    <link rel="stylesheet" href="{{ asset('frontend/plugins/aos/aos.css') }}">
    <!-- venobox popup -->
    <link rel="stylesheet" href="{{ asset('frontend/plugins/venobox/venobox.css') }}">

    <!-- Main Stylesheet -->
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

    <!-- TagsInpute -->
    <link href="{{ asset('frontend/css/bootstrap-tagsinput.css') }}" rel="stylesheet">

    <!-- Toastr Message -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <!--Favicon-->
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('frontend/images/favicon.png') }}" type="image/x-icon">

</head>

<body>

    <!-- preloader start -->
    <div class="preloader">
        <img src="{{asset('frontend/images/preloader.gif')}}" alt="preloader">
    </div>
    <!-- preloader end -->

    @include('frontend.layouts.inc._navbar')

    @yield('content')


    @include('frontend.layouts.inc.footer')


    <!-- jQuery -->
    <script src="{{ asset('frontend/plugins/jQuery/jquery.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('frontend/plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/bootstrap/bootstrap.min.js') }}"></script>
    <!-- slick slider -->
    <script src="{{ asset('frontend/plugins/slick/slick.min.js') }}"></script>
    <!-- aos -->
    <script src="{{ asset('frontend/plugins/aos/aos.js') }}"></script>
    <!-- venobox popup -->
    <script src="{{ asset('frontend/plugins/venobox/venobox.min.js') }}"></script>
    <!-- filter -->
    <script src="{{ asset('frontend/plugins/filterizr/jquery.filterizr.min.js') }}"></script>
    <!-- google map -->
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU"></script>
    <script src="{{ asset('frontend/plugins/google-map/gmap.js') }}"></script> --}}

    <!-- Main Script -->
    <script src="{{ asset('frontend/js/script.js') }}"></script>

    <!-- Toastr Message -->
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

    <!-- TagsInpute -->
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

</body>

</html>
