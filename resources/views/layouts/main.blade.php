<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ config('app.name') }}">
    <meta name="keywords" content="{{ config('app.name') }}">
    <meta name="author" content="{{ config('app.name') }}">
    <link rel="icon" href="../assets/images/favicon/1.png" type="image/x-icon">
    <title>{{ $title ?? config('app.name') }}</title>

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

<div class="mobile-menu d-md-none d-block mobile-cart">
    <ul>
        <li class="active">
            <a href="index.html">
                <i class="iconly-Home icli"></i>
                <span>Home</span>
            </a>
        </li>

        <li class="mobile-category">
            <a href="javascript:void(0)">
                <i class="iconly-Category icli js-link"></i>
                <span>Category</span>
            </a>
        </li>

        <li>
            <a href="search.html" class="search-box">
                <i class="iconly-Search icli"></i>
                <span>Search</span>
            </a>
        </li>

        <li>
            <a href="wishlist.html" class="notifi-wishlist">
                <i class="iconly-Heart icli"></i>
                <span>My Wish</span>
            </a>
        </li>

        <li>
            <a href="cart.html">
                <i class="iconly-Bag-2 icli fly-cate"></i>
                <span>Cart</span>
            </a>
        </li>
    </ul>
</div>
<!-- mobile fix menu end -->

@yield('content')

<footer class="section-t-space mt-5">
    @include('layouts.footer')
</footer>

<!-- log in section end -->

<!-- Bg overlay Start -->
<div class="bg-overlay"></div>
<!-- Bg overlay End -->

@include('layouts.script')

@yield('script')

</body>

</html>

