<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Kode Lisensi Dashboard">
<meta name="keywords" content="Kode Lisensi Dashboard">
<meta name="author" content="Kode Lisensi">
<link rel="icon" href="{{ asset('dashboard_assets/images/dashboard/LogoKodeLisensi.png') }}" type="image/x-icon">
<link rel="shortcut icon" href="{{ asset('dashboard_assets/images/dashboard/LogoKodeLisensi.png') }}"
    type="image/x-icon">
@if (request()->routeIs('articles.create'))
    <title>{{ 'Tambah Artikel - KodeLisensi.com' }}</title>
@else
    <title>{{ config('app.name') }}</title>
@endif

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
    rel="stylesheet">

<!-- Linear Icon css -->
<link rel="stylesheet" href="{{ asset('dashboard_assets/css/linearicon.css') }}">

<!-- fontawesome css -->
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/vendors/font-awesome.css') }}">

<!-- Themify icon css-->
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/vendors/themify.css') }}">

<!-- ratio css -->
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/ratio.css') }}">

<!-- remixicon css -->
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/remixicon.css') }}">

<!-- Feather icon css-->
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/vendors/feather-icon.css') }}">

<!-- Plugins css -->
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/vendors/scrollbar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/vendors/animate.css') }}">

<!-- vector map css -->
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/vector-map.css') }}">

<!-- Slick Slider Css -->
<link rel="stylesheet" href="{{ asset('dashboard_assets/css/vendors/slick.css') }}">

<!-- Bootstrap css-->
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/vendors/bootstrap.css') }}">

<!-- App css -->
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/style.css') }}">

<!-- Select2 css -->
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/select2.min.css') }}">

<!-- sweetalert css -->
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/sweetalert.min.css') }}">
