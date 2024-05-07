<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="{{ $title ?? config('app.name') }}">
    <meta name="description" content="<?php echo strip_tags($metaDescription ?? 'Kodelisensi.com - Pusatnya Lisensi Original'); ?>">
    <meta name="keywords" content="{{ $keywords ?? config('app.name') }}">
    <meta name="author" content="{{ $author ?? config('app.name') }}">
   
    @yield('meta')
    <link rel="icon" href="{{ asset('dashboard_assets/images/dashboard/LogoKodeLisensi.png') }}"
        type="image/x-icon">
    <title>{{ $title ?? 'KodeLisensi.com - Pusatnya Lisensi Original' }}</title>

    <style>
        .right-side-menu {
            display: none;
        }

        @media (max-width: 575px) {
            .right-side-menu {
                display: block;
            }
        }
    </style>

    @include('layouts.header')
    @yield('captcha')
    @yield('asset')
</head>

<body class="theme-color-3 dark">
    <!-- Loader Start -->
    <div class="fullpage-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Loader End -->

    <!-- Header Start -->
    <header class="pb-md-4 pb-0 header-2">
        @include('layouts.navbar')
    </header>
    <!-- Header End -->

    @yield('content')

    <footer class="section-t-space mt-5">
        @include('layouts.footer')
    </footer>

    <!-- log in section end -->

    <div class="theme-option">
        <div class="setting-box">
            <a target="__blank" href="https://wa.me/+6282131536153">
                <button class="btn setting-button">
                    <i class="fa-brands fa-whatsapp"></i>
                </button>
            </a>
        </div>

        <div class="back-to-top">
            <a id="back-to-top" href="#">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

    @include('layouts.script')

    @yield('script')

</body>

</html>
