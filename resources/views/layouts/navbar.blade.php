@php
    use App\Enums\UserRoleEnum;
    use App\Helpers\UserHelper;
    use App\Helpers\CategoryHelper;
@endphp
<style>
    .rightside-menu{
        margin-left: 0 !important;
    }
    .main-nav{
        padding: 0 !important;
    }
</style>
<div class="top-nav top-header">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="navbar-top justify-content-center">
                    <button class="navbar-toggler d-xl-none d-block p-0 me-3" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#primaryMenu">
                        <span class="navbar-toggler-icon">
                            <i class="iconly-Category icli theme-color"></i>
                        </span>
                    </button>
                    <a href="{{ route('home.index') }}" class="web-logo nav-logo">
                        <img width="20%"
                            src="https://kodelisensi.com/storage/site_setting//profil-kodelisensi-2024-04-05-10-03-49.png"
                            alt="Logo"> </a>

                    {{-- <div class="middle-box">
                        <div class="center-box">
                            <div class="searchbar-box order-xl-1 d-none d-xl-block">
                                <form method="GET" action="{{ route('home.products.index') }}">
                                    @csrf
                                    <input value="{{ request()->input('search') ?? old('search') }}" name="search"
                                        type="search" class="form-control" id="inputSearch"
                                        placeholder="Cari lisensi software.." autocomplete="off">
                                    <button class="btn search-button">
                                        <i class="iconly-Search icli"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="rightside-menu">
                        <div class="dropdown-dollar">
                            @guest
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="{{ route('login') }}">
                                        <span>Masuk</span>
                                    </a>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-toggle m-0" href="{{ route('register') }}">
                                        <span>Daftar</span>
                                    </a>
                                </div>
                            @else
                                <div class="dropdown">
                                    <button class="dropdown-toggle m-0" type="button" id="dropdown  MenuButton2"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span>Hi, {{ auth()->user()->name }}</span> <i class="fa-solid fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <a id="usd" class="dropdown-item"
                                                href="{{ UserHelper::getUserRole() === UserRoleEnum::ADMIN->value || UserHelper::getUserRole() === UserRoleEnum::AUTHOR->value || UserHelper::getUserRole() === UserRoleEnum::RESELLER->value || UserHelper::getUserRole() === UserRoleEnum::ADMINISTRATOR->value ? route('dashboard.index') : route('users.account.index') }}">Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <a id="inr" class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                        </li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </ul>
                                </div>
                            @endguest
                        </div>
                        <div class="option-list">
                            <ul>
                                <li>
                                    <a href="{{ route('dashboard.index') }}" class="header-icon user-icon search-icon">
                                        <i class="iconly-Profile icli"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('home.products.index') }}"
                                        class="header-icon search-box search-icon">
                                        <i class="iconly-Search icli"></i>
                                    </a>
                                </li>


                                <li class="onhover-dropdown">
                                    <a href="{{ route('users.account.my-favorites') }}" class="header-icon swap-icon">
                                        <i class="iconly-Heart icli"></i>
                                    </a>

                                </li>
                            </ul>
                        </div>
                    </div> --}}

                    <ul class="right-side-menu">
                        <li class="right-side onhover-dropdown">
                            <a href="#" class="btn p-0 position-relative header-wishlist">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </a>
                            <div class="onhover-div onhover-div-login">
                                <ul class="user-box-name">
                                    @guest
                                        <li class="product-box-contain">
                                            <a href="{{ route('login') }}">Masuk</a>
                                        </li>

                                        <li class="product-box-contain">
                                            <a href="{{ route('register') }}">Daftar</a>
                                        </li>
                                    @else
                                        <li class="product-box-contain">
                                            <a
                                                href="{{ UserHelper::getUserRole() === UserRoleEnum::ADMIN->value || UserHelper::getUserRole() === UserROleEnum::ADMINISTRATOR->value ? route('dashboard.index') : route('users.account.index') }}">Dashboard</a>
                                        </li>
                                        <li class="product-box-contain">
                                            <a id="inr" class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                Logout</a>
                                        </li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    @endguest


                                </ul>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="top-header top-nav sticky-header sticky-header-3">

    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="main-nav justify-content-between">
                    <div class="header-nav-left">
                        <button class="dropdown-category dropdown-category-2">
                            <i class="iconly-Category icli"></i>
                            <span>Semua Kategori</span>
                        </button>
                        <div class="category-dropdown">
                            <div class="category-title">
                                <h5>Categories</h5>
                                <button type="button" class="btn p-0 close-button text-content">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>

                            <ul class="category-list">
                                @foreach ($nav_categories as $category)
                                    <li class="onhover-category-list">
                                        <a href="{{ route('home.category', $category->slug) }}"
                                            class="category-name">
                                            <h6>{{ $category->name }}</h6>
                                            <i class="fa-solid fa-angle-right"></i>
                                        </a>
                                        <div class="onhover-category-box">
                                            <div class="list-1">
                                                <div class="category-title-box">
                                                    <h5>{{ $category->name }}</h5>
                                                </div>
                                                <ul>
                                                    @forelse($category->products as $product)
                                                        <li>
                                                            <a
                                                                href="{{ route('home.products.show', $product->slug) }}">{{ $product->name }}</a>
                                                        </li>
                                                    @empty
                                                        Belum ada Produk
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                        <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                            <div class="offcanvas-header navbar-shadow">
                                <h5>Menu</h5>
                                <button class="btn-close lead" type="button" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('home.index') ? 'active' : '' }}"
                                            href="{{ route('home.index') }}">Beranda</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('home.products.*') ? 'active' : '' }}"
                                            href="{{ route('home.products.index') }}">Produk</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('home.about') ? 'active' : '' }}"
                                            href="{{ route('home.about') }}">Tentang Kami</a>
                                    </li>
                                    <li class="nav-item dropdown new-nav-item">
                                        {{-- <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                        data-bs-toggle="dropdown">Blog</a> --}}

                                        <a class="nav-link dropdown-toggle"
                                            href="{{ route('home.articles.index') }}">Blog</a>
                                        <ul class="dropdown-menu">
                                            @foreach (CategoryHelper::articleCategory() as $articleCategory)
                                                <li class="sub-dropdown-hover">
                                                    <a class="dropdown-item"
                                                        href="javascript:void(0)">{{ $articleCategory->name }}</a>
                                                    <ul class="sub-menu">
                                                        @forelse ($articleCategory->sub_article_categories as $sub_article_category)
                                                            <li>
                                                                <a
                                                                    href="{{ route('home.articles.index') . '?sub_category=' . $sub_article_category->name }}">{{ $sub_article_category->name }}</a>
                                                            </li>
                                                        @empty
                                                            <p style="font-size: 13px">Belum mempunyai Sub-Kategori</p>
                                                        @endforelse
                                                    </ul>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('home.contact.index') ? 'active' : '' }}"
                                            href="{{ route('home.contact.index') }}">Hubungi Kami</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('home.faq') ? 'active' : '' }}"
                                            href="{{ route('home.faq') }}">Bantuan</a>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="btn search-button" data-bs-toggle="modal"
                                            data-bs-target="#searchModal">
                                            <i class="iconly-Search icli"></i>
                                        </button>
                                    </li>

                                </ul>

                            </div>
                        </div>
                    </div>


                    <div class="rightside-menu">
                        <div class="dropdown-dollar">
                            @guest
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="{{ route('login') }}">
                                        <span>Masuk</span>
                                    </a>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-toggle m-0" href="{{ route('register') }}">
                                        <span>Daftar</span>
                                    </a>
                                </div>
                            @else
                                <div class="dropdown">
                                    <button class="dropdown-toggle m-0" type="button" id="dropdown  MenuButton2"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span>Hi, {{ auth()->user()->name }}</span> <i class="fa-solid fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <a id="usd" class="dropdown-item"
                                                href="{{ UserHelper::getUserRole() === UserRoleEnum::ADMIN->value || UserHelper::getUserRole() === UserRoleEnum::AUTHOR->value || UserHelper::getUserRole() === UserRoleEnum::RESELLER->value || UserHelper::getUserRole() === UserRoleEnum::ADMINISTRATOR->value ? route('dashboard.index') : route('users.account.index') }}">Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <a id="inr" class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                        </li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </ul>
                                </div>
                            @endguest
                        </div>
                        <div class="option-list">
                            <ul>
                                <li>
                                    <a href="{{ route('dashboard.index') }}"
                                        class="header-icon user-icon search-icon">
                                        <i class="iconly-Profile icli"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('home.products.index') }}"
                                        class="header-icon search-box search-icon">
                                        <i class="iconly-Search icli"></i>
                                    </a>
                                </li>


                                <li class="onhover-dropdown">
                                    <a href="{{ route('users.account.my-favorites') }}"
                                        class="header-icon swap-icon">
                                        <i class="iconly-Heart icli"></i>
                                    </a>

                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<x-search-modal></x-search-modal>
