<div class="logo-wrapper logo-wrapper-center">
    <a href="{{ route('dashboard.index') }}" data-bs-original-title="" title="">
        <h2 class="text-white">{{ config('app.name') }}</h2>
    </a>
    <div class="back-btn">
        <i class="fa fa-angle-left"></i>
    </div>
    <div class="toggle-sidebar">
        <i class="ri-apps-line status_toggle middle sidebar-toggle"></i>
    </div>
</div>
<div class="logo-icon-wrapper">
    <a href="{{ route('home.index') }}">
        <img class="img-fluid main-logo main-white" src="assets/images/logo/logo.png" alt="logo">
        <img class="img-fluid main-logo main-dark" src="assets/images/logo/logo-white.png"
             alt="logo">
    </a>
</div>
<nav class="sidebar-main">
    <div class="left-arrow" id="left-arrow">
        <i data-feather="arrow-left"></i>
    </div>

    <div id="sidebar-menu">
        @include('dashboard.layouts.sidebar')
    </div>

    <div class="right-arrow" id="right-arrow">
        <i data-feather="arrow-right"></i>
    </div>
</nav>
