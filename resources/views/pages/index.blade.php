@php use App\Helpers\ArticleHelper;use App\Helpers\CategoryHelper;use App\Helpers\HomeHelper;use Carbon\Carbon; @endphp
@extends('layouts.main')
@section('content')

    <!-- Home Section Start -->
    <section class="home-section-2 home-section-bg pt-0 overflow-hidden">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="slider-animate">
                        <div>
                            <div class="home-contain rounded-0 p-0">
                                <img src="../assets/images/grocery/banner/1.jpg"
                                     class="img-fluid bg-img blur-up lazyload" alt="">
                                <div class="home-detail home-big-space p-center-left home-overlay position-relative">
                                    <div class="container-fluid-lg">
                                        <div>
                                            <h6 class="ls-expanded theme-color text-uppercase">Weekend Special offer
                                            </h6>
                                            <h1 class="heding-2">Premium Quality Dry Fruits</h1>
                                            <h2 class="content-2">Dryfruits shopping made Easy</h2>
                                            <h5 class="text-content">Fresh & Top Quality Dry Fruits are available here!
                                            </h5>
                                            <button
                                                class="btn theme-bg-color btn-md text-white fw-bold mt-md-4 mt-2 mend-auto"
                                                onclick="location.href = 'shop-left-sidebar.html';">Shop Now <i
                                                    class="fa-solid fa-arrow-right icon"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Home Section End -->

    <section class="banner-section banner-small ratio_65">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="slider-4-banner no-arrow slick-height slick-slider">
                    <div class="slick-list draggable">
                        <div class="slick-track"
                             style="opacity: 1; width: 1292px; transform: translate3d(0px, 0px, 0px);">
                            <div class="slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false"
                                 tabindex="0" style="width: 323px;">
                                <div class=" banner-contain-3 hover-effect">
                                    <a href="javascript:void(0)" tabindex="0" class="bg-size blur-up lazyloaded"
                                       style="background-image: url(&quot;../assets/images/grocery/banner/2.jpg&quot;); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;">
                                        <img src="../assets/images/grocery/banner/2.jpg" class="bg-img blur-up lazyload"
                                             alt="" style="display: none;">
                                    </a>
                                    <div class="banner-detail p-center-left w-75 banner-p-sm mend-auto">
                                        <div>
                                            <h5 class="fw-light mb-2">50% Discount</h5>
                                            <h4 class="fw-bold mb-0">Summer Ice Cream</h4>
                                            <button onclick="location.href = 'shop-left-sidebar.html';"
                                                    class="btn shop-now-button mt-3 ps-0 mend-auto theme-color fw-bold"
                                                    tabindex="0">Shop Now <i class="fa-solid fa-chevron-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slick-slide slick-active" data-slick-index="1" aria-hidden="false" tabindex="0"
                                 style="width: 323px;">
                                <div class="banner-contain-3 hover-effect">
                                    <a href="javascript:void(0)" tabindex="0" class="bg-size"
                                       style="background-image: url(&quot;../assets/images/grocery/banner/3.jpg&quot;); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;">
                                        <img src="../assets/images/grocery/banner/3.jpg" class="img-fluid bg-img" alt=""
                                             style="display: none;">
                                    </a>
                                    <div class="banner-detail p-center-left w-75 banner-p-sm mend-auto">
                                        <div>
                                            <h5 class="fw-light mb-2">Today Special</h5>
                                            <h4 class="fw-bold mb-0">Fruits Juice Series</h4>
                                            <button onclick="location.href = 'shop-left-sidebar.html';"
                                                    class="btn shop-now-button mt-3 ps-0 mend-auto theme-color fw-bold"
                                                    tabindex="0">Shop Now <i class="fa-solid fa-chevron-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slick-slide slick-active" data-slick-index="2" aria-hidden="false" tabindex="0"
                                 style="width: 323px;">
                                <div class="banner-contain-3 hover-effect">
                                    <a href="javascript:void(0)" tabindex="0" class="bg-size blur-up lazyloaded"
                                       style="background-image: url(&quot;../assets/images/grocery/banner/4.jpg&quot;); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;">
                                        <img src="../assets/images/grocery/banner/4.jpg" class="blur-up lazyload bg-img"
                                             alt="" style="display: none;">
                                    </a>
                                    <div class="banner-detail p-center-left w-75 banner-p-sm mend-auto">
                                        <div>
                                            <h5 class="fw-light mb-2">Combo Offer</h5>
                                            <h4 class="fw-bold mb-0">Eat Healthy Be Healthy </h4>
                                            <button onclick="location.href = 'shop-left-sidebar.html';"
                                                    class="btn shop-now-button mt-3 ps-0 mend-auto theme-color fw-bold"
                                                    tabindex="0">Shop Now <i class="fa-solid fa-chevron-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slick-slide slick-active" data-slick-index="3" aria-hidden="false" tabindex="0"
                                 style="width: 323px;">
                                <div class="banner-contain-3 hover-effect">
                                    <a href="javascript:void(0)" tabindex="0" class="bg-size blur-up lazyloaded"
                                       style="background-image: url(&quot;../assets/images/grocery/banner/5.jpg&quot;); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;">
                                        <img src="../assets/images/grocery/banner/5.jpg" class="blur-up lazyload bg-img"
                                             alt="" style="display: none;">
                                    </a>
                                    <div class="banner-detail p-center-left w-75 banner-p-sm mend-auto">
                                        <div>
                                            <h5 class="fw-light mb-2">Amazing Deals</h5>
                                            <h4 class="fw-bold mb-0">As Fresh As Fruit </h4>
                                            <button onclick="location.href = 'shop-left-sidebar.html';"
                                                    class="btn shop-now-button mt-3 ps-0 mend-auto theme-color fw-bold"
                                                    tabindex="0">Shop Now <i class="fa-solid fa-chevron-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="service-section">
        <div class="container-fluid-lg">
            <div class="row g-3 row-cols-xxl-5 row-cols-lg-3 row-cols-md-2">
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="../assets/svg/svg/service-icon-4.svg#shipping"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>Free Shipping</h3>
                            <h6 class="text-content">Free Shipping world wide</h6>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="{{ asset('assets/svg/svg/service-icon-4.svg#service') }}"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>24 x 7 Service</h3>
                            <h6 class="text-content">Online Service For 24 x 7</h6>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="{{ asset('assets/svg/svg/service-icon-4.svg#pay') }}"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>Online Pay</h3>
                            <h6 class="text-content">Online Payment Avaible</h6>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="{{ asset('assets/svg/svg/service-icon-4.svg#offer') }}"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>Festival Offer</h3>
                            <h6 class="text-content">Super Sale Upto 50% off</h6>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="{{ asset('assets/svg/svg/service-icon-4.svg#return') }}"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>100% Original</h3>
                            <h6 class="text-content">100% Money Back</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-9 col-xl-8">
                    <div class="title title-flex">
                        <div>
                            <h2>Produk Terlaris</h2>
                            <span class="title-leaf">
                                <svg class="icon-width">
                                    <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                </svg>
                            </span>
                            <p>Don't miss this opportunity at a special discount just for this week.</p>
                        </div>
                    </div>

                    <div class="section-b-space">
                        <div class="row row-cols-xxl-5 row-cols-md-4 row-cols-sm-3 row-cols-2 g-sm-4 g-3 no-arrow">
                            <div>
                                <div class="product-box product-white-bg wow fadeIn"
                                     style="visibility: visible; animation-name: fadeIn;">
                                    <div class="product-image">
                                        <a href="product-left-thumbnail.html">
                                            <img src="../assets/images/furniture/1.png"
                                                 class="img-fluid blur-up lazyloaded" alt="">
                                        </a>
                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                   data-bs-target="#view">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-eye">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Compare">
                                                <a href="compare.html">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-refresh-cw">
                                                        <polyline points="23 4 23 10 17 10"></polyline>
                                                        <polyline points="1 20 1 14 7 14"></polyline>
                                                        <path
                                                            d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Wishlist">
                                                <a href="wishlist.html" class="notifi-wishlist">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-heart">
                                                        <path
                                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-detail position-relative">
                                        <a href="product-left-thumbnail.html">
                                            <h6 class="name" style="min-height: 0px; max-height: none; height: 44px;">
                                                Home Decor Lucky Deer Family Matte Finish Ceramic Figures
                                            </h6>
                                        </a>

                                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                                        <h6 class="price theme-color">$ 80.00</h6>

                                        <div class="add-to-cart-btn-2 add-to-cart-box addtocart_btn">
                                            <button class="btn addcart-button btn buy-button"><i
                                                    class="fa-solid fa-plus"></i></button>
                                            <div class="cart_qty qty-box-2">
                                                <div class="input-group">
                                                    <button type="button" class="qty-left-minus" data-type="minus"
                                                            data-field="">
                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                           name="quantity" value="1">
                                                    <button type="button" class="qty-right-plus" data-type="plus"
                                                            data-field="">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box product-white-bg wow fadeIn" data-wow-delay="0.1s"
                                     style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                    <div class="product-image">
                                        <a href="product-left-thumbnail.html">
                                            <img src="../assets/images/furniture/2.png"
                                                 class="img-fluid blur-up lazyloaded" alt="">
                                        </a>
                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                   data-bs-target="#view">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-eye">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Compare">
                                                <a href="compare.html">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-refresh-cw">
                                                        <polyline points="23 4 23 10 17 10"></polyline>
                                                        <polyline points="1 20 1 14 7 14"></polyline>
                                                        <path
                                                            d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Wishlist">
                                                <a href="wishlist.html" class="notifi-wishlist">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-heart">
                                                        <path
                                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-detail position-relative">
                                        <a href="product-left-thumbnail.html">
                                            <h6 class="name" style="min-height: 0px; max-height: none; height: 44px;">
                                                luxury comfort full size 17*27 jumbo border pillow</h6>
                                        </a>

                                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                                        <h6 class="price theme-color">$ 80.00</h6>

                                        <div class="add-to-cart-btn-2 addtocart_btn">
                                            <button class="btn addcart-button btn buy-button"><i
                                                    class="fa-solid fa-plus"></i></button>
                                            <div class="cart_qty qty-box-2">
                                                <div class="input-group">
                                                    <button type="button" class="qty-left-minus" data-type="minus"
                                                            data-field="">
                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                           name="quantity" value="1">
                                                    <button type="button" class="qty-right-plus" data-type="plus"
                                                            data-field="">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box product-white-bg wow fadeIn"
                                     style="visibility: visible; animation-name: fadeIn;">
                                    <div class="product-image">
                                        <a href="product-left-thumbnail.html">
                                            <img src="../assets/images/furniture/3.png"
                                                 class="img-fluid blur-up lazyloaded" alt="">
                                        </a>
                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                   data-bs-target="#view">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-eye">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Compare">
                                                <a href="compare.html">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-refresh-cw">
                                                        <polyline points="23 4 23 10 17 10"></polyline>
                                                        <polyline points="1 20 1 14 7 14"></polyline>
                                                        <path
                                                            d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Wishlist">
                                                <a href="wishlist.html" class="notifi-wishlist">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-heart">
                                                        <path
                                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-detail position-relative">
                                        <a href="product-left-thumbnail.html">
                                            <h6 class="name" style="min-height: 0px; max-height: none; height: 44px;">
                                                Coral Bean Bag Chair</h6>
                                        </a>

                                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                                        <h6 class="price theme-color">$ 80.00</h6>

                                        <div class="add-to-cart-btn-2 addtocart_btn">
                                            <button class="btn addcart-button btn buy-button"><i
                                                    class="fa-solid fa-plus"></i></button>
                                            <div class="cart_qty qty-box-2">
                                                <div class="input-group">
                                                    <button type="button" class="qty-left-minus" data-type="minus"
                                                            data-field="">
                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                           name="quantity" value="1">
                                                    <button type="button" class="qty-right-plus" data-type="plus"
                                                            data-field="">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box product-white-bg wow fadeIn" data-wow-delay="0.1s"
                                     style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                    <div class="product-image">
                                        <a href="product-left-thumbnail.html">
                                            <img src="../assets/images/furniture/4.png"
                                                 class="img-fluid blur-up lazyloaded" alt="">
                                        </a>
                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                   data-bs-target="#view">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-eye">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Compare">
                                                <a href="compare.html">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-refresh-cw">
                                                        <polyline points="23 4 23 10 17 10"></polyline>
                                                        <polyline points="1 20 1 14 7 14"></polyline>
                                                        <path
                                                            d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Wishlist">
                                                <a href="wishlist.html" class="notifi-wishlist">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-heart">
                                                        <path
                                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-detail position-relative">
                                        <a href="product-left-thumbnail.html">
                                            <h6 class="name" style="min-height: 0px; max-height: none; height: 44px;">
                                                ELSTONE HOME White Colour Bath Towel</h6>
                                        </a>

                                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                                        <h6 class="price theme-color">$ 80.00</h6>

                                        <div class="add-to-cart-btn-2 addtocart_btn">
                                            <button class="btn addcart-button btn buy-button"><i
                                                    class="fa-solid fa-plus"></i></button>
                                            <div class="cart_qty qty-box-2">
                                                <div class="input-group">
                                                    <button type="button" class="qty-left-minus" data-type="minus"
                                                            data-field="">
                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                           name="quantity" value="1">
                                                    <button type="button" class="qty-right-plus" data-type="plus"
                                                            data-field="">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box product-white-bg wow fadeIn"
                                     style="visibility: visible; animation-name: fadeIn;">
                                    <div class="product-image">
                                        <a href="product-left-thumbnail.html">
                                            <img src="../assets/images/furniture/5.png"
                                                 class="img-fluid blur-up lazyloaded" alt="">
                                        </a>
                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                   data-bs-target="#view">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-eye">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Compare">
                                                <a href="compare.html">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-refresh-cw">
                                                        <polyline points="23 4 23 10 17 10"></polyline>
                                                        <polyline points="1 20 1 14 7 14"></polyline>
                                                        <path
                                                            d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Wishlist">
                                                <a href="wishlist.html" class="notifi-wishlist">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-heart">
                                                        <path
                                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-detail position-relative">
                                        <a href="product-left-thumbnail.html">
                                            <h6 class="name" style="min-height: 0px; max-height: none; height: 44px;">
                                                Benefits of using natural stone tile flooring</h6>
                                        </a>

                                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                                        <h6 class="price theme-color">$ 80.00</h6>

                                        <div class="add-to-cart-btn-2 addtocart_btn">
                                            <button class="btn addcart-button btn buy-button"><i
                                                    class="fa-solid fa-plus"></i></button>
                                            <div class="cart_qty qty-box-2">
                                                <div class="input-group">
                                                    <button type="button" class="qty-left-minus" data-type="minus"
                                                            data-field="">
                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                           name="quantity" value="1">
                                                    <button type="button" class="qty-right-plus" data-type="plus"
                                                            data-field="">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box product-white-bg wow fadeIn" data-wow-delay="0.1s"
                                     style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                    <div class="product-image">
                                        <a href="product-left-thumbnail.html">
                                            <img src="../assets/images/furniture/6.png"
                                                 class="img-fluid blur-up lazyloaded" alt="">
                                        </a>
                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                   data-bs-target="#view">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-eye">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Compare">
                                                <a href="compare.html">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-refresh-cw">
                                                        <polyline points="23 4 23 10 17 10"></polyline>
                                                        <polyline points="1 20 1 14 7 14"></polyline>
                                                        <path
                                                            d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Wishlist">
                                                <a href="wishlist.html" class="notifi-wishlist">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-heart">
                                                        <path
                                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-detail position-relative">
                                        <a href="product-left-thumbnail.html">
                                            <h6 class="name" style="min-height: 0px; max-height: none; height: 44px;">
                                                Nature Baby Merino Knit Bassinet Blanket</h6>
                                        </a>

                                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                                        <h6 class="price theme-color">$ 80.00</h6>

                                        <div class="add-to-cart-btn-2 addtocart_btn">
                                            <button class="btn addcart-button btn buy-button"><i
                                                    class="fa-solid fa-plus"></i></button>
                                            <div class="cart_qty qty-box-2">
                                                <div class="input-group">
                                                    <button type="button" class="qty-left-minus" data-type="minus"
                                                            data-field="">
                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                           name="quantity" value="1">
                                                    <button type="button" class="qty-right-plus" data-type="plus"
                                                            data-field="">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box product-white-bg wow fadeIn"
                                     style="visibility: visible; animation-name: fadeIn;">
                                    <div class="product-image">
                                        <a href="product-left-thumbnail.html">
                                            <img src="../assets/images/furniture/7.png"
                                                 class="img-fluid blur-up lazyloaded" alt="">
                                        </a>
                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                   data-bs-target="#view">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-eye">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Compare">
                                                <a href="compare.html">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-refresh-cw">
                                                        <polyline points="23 4 23 10 17 10"></polyline>
                                                        <polyline points="1 20 1 14 7 14"></polyline>
                                                        <path
                                                            d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Wishlist">
                                                <a href="wishlist.html" class="notifi-wishlist">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-heart">
                                                        <path
                                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-detail position-relative">
                                        <a href="product-left-thumbnail.html">
                                            <h6 class="name" style="min-height: 0px; max-height: none; height: 44px;">
                                                Wooden Tea Cup Coaster Coffee Drinks</h6>
                                        </a>

                                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                                        <h6 class="price theme-color">$ 80.00</h6>

                                        <div class="add-to-cart-btn-2 addtocart_btn">
                                            <button class="btn addcart-button btn buy-button"><i
                                                    class="fa-solid fa-plus"></i></button>
                                            <div class="cart_qty qty-box-2">
                                                <div class="input-group">
                                                    <button type="button" class="qty-left-minus" data-type="minus"
                                                            data-field="">
                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                           name="quantity" value="1">
                                                    <button type="button" class="qty-right-plus" data-type="plus"
                                                            data-field="">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>

                                <div class="product-box product-white-bg wow fadeIn" data-wow-delay="0.1s"
                                     style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                    <div class="product-image">
                                        <a href="product-left-thumbnail.html">
                                            <img src="../assets/images/furniture/8.png"
                                                 class="img-fluid blur-up lazyloaded" alt="">
                                        </a>
                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                   data-bs-target="#view">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-eye">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Compare">
                                                <a href="compare.html">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-refresh-cw">
                                                        <polyline points="23 4 23 10 17 10"></polyline>
                                                        <polyline points="1 20 1 14 7 14"></polyline>
                                                        <path
                                                            d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Wishlist">
                                                <a href="wishlist.html" class="notifi-wishlist">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-heart">
                                                        <path
                                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-detail position-relative">
                                        <a href="product-left-thumbnail.html">
                                            <h6 class="name" style="min-height: 0px; max-height: none; height: 44px;">
                                                Goddess Marble Hexagon Party Plates</h6>
                                        </a>

                                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                                        <h6 class="price theme-color">$ 80.00</h6>

                                        <div class="add-to-cart-btn-2 addtocart_btn">
                                            <button class="btn addcart-button btn buy-button"><i
                                                    class="fa-solid fa-plus"></i></button>
                                            <div class="cart_qty qty-box-2">
                                                <div class="input-group">
                                                    <button type="button" class="qty-left-minus" data-type="minus"
                                                            data-field="">
                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                           name="quantity" value="1">
                                                    <button type="button" class="qty-right-plus" data-type="plus"
                                                            data-field="">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="product-box product-white-bg wow fadeIn"
                                     style="visibility: visible; animation-name: fadeIn;">
                                    <div class="product-image">
                                        <a href="product-left-thumbnail.html">
                                            <img src="../assets/images/furniture/9.png"
                                                 class="img-fluid blur-up lazyloaded" alt="">
                                        </a>
                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                   data-bs-target="#view">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-eye">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Compare">
                                                <a href="compare.html">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-refresh-cw">
                                                        <polyline points="23 4 23 10 17 10"></polyline>
                                                        <polyline points="1 20 1 14 7 14"></polyline>
                                                        <path
                                                            d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Wishlist">
                                                <a href="wishlist.html" class="notifi-wishlist">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-heart">
                                                        <path
                                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-detail position-relative">
                                        <a href="product-left-thumbnail.html">
                                            <h6 class="name" style="min-height: 0px; max-height: none; height: 44px;">
                                                Handmade Brown Mango Wooden Tray Square</h6>
                                        </a>

                                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                                        <h6 class="price theme-color">$ 80.00</h6>

                                        <div class="add-to-cart-btn-2 addtocart_btn">
                                            <button class="btn addcart-button btn buy-button"><i
                                                    class="fa-solid fa-plus"></i></button>
                                            <div class="cart_qty qty-box-2">
                                                <div class="input-group">
                                                    <button type="button" class="qty-left-minus" data-type="minus"
                                                            data-field="">
                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                           name="quantity" value="1">
                                                    <button type="button" class="qty-right-plus" data-type="plus"
                                                            data-field="">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>

                                <div class="product-box product-white-bg wow fadeIn" data-wow-delay="0.1s"
                                     style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                    <div class="product-image">
                                        <a href="product-left-thumbnail.html">
                                            <img src="../assets/images/furniture/10.png"
                                                 class="img-fluid blur-up lazyloaded" alt="">
                                        </a>
                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                   data-bs-target="#view">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-eye">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Compare">
                                                <a href="compare.html">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-refresh-cw">
                                                        <polyline points="23 4 23 10 17 10"></polyline>
                                                        <polyline points="1 20 1 14 7 14"></polyline>
                                                        <path
                                                            d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                                                    </svg>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Wishlist">
                                                <a href="wishlist.html" class="notifi-wishlist">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-heart">
                                                        <path
                                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-detail position-relative">
                                        <a href="product-left-thumbnail.html">
                                            <h6 class="name" style="min-height: 0px; max-height: none; height: 44px;">
                                                heavy duty cane round basket</h6>
                                        </a>

                                        <h6 class="sold weight text-content fw-normal">1 KG</h6>

                                        <h6 class="price theme-color">$ 80.00</h6>

                                        <div class="add-to-cart-btn-2 addtocart_btn">
                                            <button class="btn addcart-button btn buy-button"><i
                                                    class="fa-solid fa-plus"></i></button>
                                            <div class="cart_qty qty-box-2">
                                                <div class="input-group">
                                                    <button type="button" class="qty-left-minus" data-type="minus"
                                                            data-field="">
                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                           name="quantity" value="1">
                                                    <button type="button" class="qty-right-plus" data-type="plus"
                                                            data-field="">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="title">
                        <h2>Produk Rating Tertinggi</h2>
                        <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                            </svg>
                        </span>
                        <p>Top Categories Of The Week</p>
                    </div>

                    <div class="category-slider-2 product-wrapper no-arrow slick-initialized slick-slider slick-dotted">
                        <button class="slick-prev slick-arrow" aria-label="Previous" type="button"
                                style="display: inline-block;">Previous
                        </button>


                        <div class="slick-list draggable">
                            <div class="slick-track"
                                 style="opacity: 1; width: 3686px; transform: translate3d(-1358px, 0px, 0px);">
                                <div class="slick-slide slick-cloned" style="width: 194px;" tabindex="-1"
                                     role="tabpanel" id="" aria-describedby="slick-slide-control02"
                                     data-slick-index="-5" aria-hidden="true">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="-1">
                                        <div>
                                            <img src="../assets/images/furniture/icon/cushions.svg"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>Cushions</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 194px;" tabindex="-1"
                                     role="tabpanel" id="" aria-describedby="slick-slide-control03"
                                     data-slick-index="-4" aria-hidden="true">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="-1">
                                        <div>
                                            <img src="../assets/images/furniture/icon/blankets.svg"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>Blankets</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 194px;" tabindex="-1"
                                     role="tabpanel" id="" aria-describedby="slick-slide-control04"
                                     data-slick-index="-3" aria-hidden="true">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="-1">
                                        <div>
                                            <img src="../assets/images/furniture/icon/gift.svg"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>Giftwraps</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 194px;" tabindex="-1"
                                     role="tabpanel" id="" aria-describedby="slick-slide-control05"
                                     data-slick-index="-2" aria-hidden="true">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="-1">
                                        <div>
                                            <img src="../assets/images/furniture/icon/sleepware.svg"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>Sleepwear</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 194px;" tabindex="-1"
                                     role="tabpanel" id="" aria-describedby="slick-slide-control06"
                                     data-slick-index="-1" aria-hidden="true">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="-1">
                                        <div>
                                            <img src="../assets/images/furniture/icon/bakeware.svg"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>Cookware &amp; Bakeware</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="slick-slide" style="width: 194px;" tabindex="-1" role="tabpanel"
                                     id="slick-slide00" aria-describedby="slick-slide-control00" data-slick-index="0"
                                     aria-hidden="true">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="-1">
                                        <div>
                                            <img src="../assets/images/furniture/icon/decorations.svg"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>Decorations</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="slick-slide" style="width: 194px;" tabindex="-1" role="tabpanel"
                                     id="slick-slide01" aria-describedby="slick-slide-control01" data-slick-index="1"
                                     aria-hidden="true">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="-1">
                                        <div>
                                            <img src="../assets/images/furniture/icon/pillows.svg"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>Bed linen</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="slick-slide slick-current slick-active" style="width: 194px;" tabindex="0"
                                     role="tabpanel" id="slick-slide02" aria-describedby="slick-slide-control02"
                                     data-slick-index="2" aria-hidden="false">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="0">
                                        <div>
                                            <img src="../assets/images/furniture/icon/cushions.svg"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>Cushions</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="slick-slide slick-active" style="width: 194px;" tabindex="0" role="tabpanel"
                                     id="slick-slide03" aria-describedby="slick-slide-control03" data-slick-index="3"
                                     aria-hidden="false">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="0">
                                        <div>
                                            <img src="../assets/images/furniture/icon/blankets.svg"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>Blankets</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="slick-slide slick-active" style="width: 194px;" tabindex="0" role="tabpanel"
                                     id="slick-slide04" aria-describedby="slick-slide-control04" data-slick-index="4"
                                     aria-hidden="false">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="0">
                                        <div>
                                            <img src="../assets/images/furniture/icon/gift.svg"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>Giftwraps</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="slick-slide slick-active" style="width: 194px;" tabindex="0" role="tabpanel"
                                     id="slick-slide05" aria-describedby="slick-slide-control05" data-slick-index="5"
                                     aria-hidden="false">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="0">
                                        <div>
                                            <img src="../assets/images/furniture/icon/sleepware.svg"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>Sleepwear</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="slick-slide slick-active" style="width: 194px;" tabindex="0" role="tabpanel"
                                     id="slick-slide06" aria-describedby="slick-slide-control06" data-slick-index="6"
                                     aria-hidden="false">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="0">
                                        <div>
                                            <img src="../assets/images/furniture/icon/bakeware.svg"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>Cookware &amp; Bakeware</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 194px;" tabindex="-1"
                                     role="tabpanel" id="" aria-describedby="slick-slide-control00" data-slick-index="7"
                                     aria-hidden="true">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="-1">
                                        <div>
                                            <img src="../assets/images/furniture/icon/decorations.svg"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>Decorations</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 194px;" tabindex="-1"
                                     role="tabpanel" id="" aria-describedby="slick-slide-control01" data-slick-index="8"
                                     aria-hidden="true">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="-1">
                                        <div>
                                            <img src="../assets/images/furniture/icon/pillows.svg"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>Bed linen</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 194px;" tabindex="-1"
                                     role="tabpanel" id="" aria-describedby="slick-slide-control02" data-slick-index="9"
                                     aria-hidden="true">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="-1">
                                        <div>
                                            <img src="../assets/images/furniture/icon/cushions.svg"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>Cushions</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 194px;" tabindex="-1"
                                     role="tabpanel" id="" aria-describedby="slick-slide-control03"
                                     data-slick-index="10" aria-hidden="true">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="-1">
                                        <div>
                                            <img src="../assets/images/furniture/icon/blankets.svg"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>Blankets</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 194px;" tabindex="-1"
                                     role="tabpanel" id="" aria-describedby="slick-slide-control04"
                                     data-slick-index="11" aria-hidden="true">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="-1">
                                        <div>
                                            <img src="../assets/images/furniture/icon/gift.svg"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>Giftwraps</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 194px;" tabindex="-1"
                                     role="tabpanel" id="" aria-describedby="slick-slide-control05"
                                     data-slick-index="12" aria-hidden="true">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="-1">
                                        <div>
                                            <img src="../assets/images/furniture/icon/sleepware.svg"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>Sleepwear</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 194px;" tabindex="-1"
                                     role="tabpanel" id="" aria-describedby="slick-slide-control06"
                                     data-slick-index="13" aria-hidden="true">
                                    <a href="shop-left-sidebar.html" class="category-box category-dark" tabindex="-1">
                                        <div>
                                            <img src="../assets/images/furniture/icon/bakeware.svg"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>Cookware &amp; Bakeware</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <button class="slick-next slick-arrow" aria-label="Next" type="button"
                                style="display: inline-block;">Next
                        </button>
                        <ul class="slick-dots" style="" role="tablist">
                            <li class="" role="presentation">
                                <button type="button" role="tab" id="slick-slide-control00"
                                        aria-controls="slick-slide00" aria-label="1 of 2" tabindex="-1">1
                                </button>
                            </li>
                            <li role="presentation" class="">
                                <button type="button" role="tab" id="slick-slide-control01"
                                        aria-controls="slick-slide01" aria-label="2 of 2" tabindex="-1">2
                                </button>
                            </li>
                            <li role="presentation" class="slick-active">
                                <button type="button" role="tab" id="slick-slide-control02"
                                        aria-controls="slick-slide02" aria-label="3 of 2" tabindex="0"
                                        aria-selected="true">3
                                </button>
                            </li>
                            <li class="" role="presentation">
                                <button type="button" role="tab" id="slick-slide-control03"
                                        aria-controls="slick-slide03" aria-label="4 of 2" tabindex="-1">4
                                </button>
                            </li>
                            <li role="presentation" class="">
                                <button type="button" role="tab" id="slick-slide-control04"
                                        aria-controls="slick-slide04" aria-label="5 of 2" tabindex="-1">5
                                </button>
                            </li>
                            <li role="presentation" class="">
                                <button type="button" role="tab" id="slick-slide-control05"
                                        aria-controls="slick-slide05" aria-label="6 of 2" tabindex="-1">6
                                </button>
                            </li>
                            <li role="presentation" class="">
                                <button type="button" role="tab" id="slick-slide-control06"
                                        aria-controls="slick-slide06" aria-label="7 of 2" tabindex="-1">7
                                </button>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="col-xxl-3 col-xl-4 d-none d-xl-block">
                    <div class="p-sticky">
                        <div class="category-menu">
                            <h3>Kategori Terpopuler</h3>
                            <ul class="border-bottom-0">
                                @foreach(CategoryHelper::topCategory() as $categories)
                                    <li>
                                        <div class="category-list">
                                            <img src="{{ asset('storage/' . $categories->icon) }}"
                                                 class="blur-up lazyloaded" alt="">
                                            <h5>
                                                <a href="{{ route('home.products.index') }}">{{ $categories->name }}</a>
                                            </h5>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Personal Care</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="slider-7_1 arrow-slider img-slider slick-initialized slick-slider">
                        <button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="">Previous
                        </button>


                        <div class="slick-list draggable">
                            <div class="slick-track"
                                 style="opacity: 1; width: 4752px; transform: translate3d(-1728px, 0px, 0px);">
                                <div class="slick-slide slick-cloned" style="width: 216px;" data-slick-index="-6" id=""
                                     aria-hidden="true" tabindex="-1">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.1s"
                                         style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <img src="../assets/images/grocery/product/personal-care/3.png"
                                                     class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="-1">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="-1">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="-1">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <h5 class="name text-title">Hand Wash</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="-1">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="-1">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="-1">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="-1">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 216px;" data-slick-index="-5" id=""
                                     aria-hidden="true" tabindex="-1">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.15s"
                                         style="visibility: visible; animation-delay: 0.15s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <img src="../assets/images/grocery/product/personal-care/4.png"
                                                     class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="-1">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="-1">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="-1">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <h5 class="name text-title">Whisper</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="-1">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="-1">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="-1">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="-1">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 216px;" data-slick-index="-4" id=""
                                     aria-hidden="true" tabindex="-1">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.2s"
                                         style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <img src="../assets/images/grocery/product/personal-care/5.png"
                                                     class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="-1">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="-1">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="-1">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <h5 class="name text-title">Whisper</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="-1">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="-1">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="-1">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="-1">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 216px;" data-slick-index="-3" id=""
                                     aria-hidden="true" tabindex="-1">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.25s"
                                         style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <img src="../assets/images/grocery/product/personal-care/6.png"
                                                     class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="-1">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="-1">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="-1">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <h5 class="name text-title">Hair Color</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="-1">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="-1">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="-1">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="-1">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 216px;" data-slick-index="-2" id=""
                                     aria-hidden="true" tabindex="-1">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.3s"
                                         style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <img src="../assets/images/grocery/product/personal-care/7.png"
                                                     class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="-1">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="-1">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="-1">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <h5 class="name text-title">Face Wash</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="-1">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="-1">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="-1">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="-1">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 216px;" data-slick-index="-1" id=""
                                     aria-hidden="true" tabindex="-1">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.35s"
                                         style="visibility: visible; animation-delay: 0.35s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <img src="../assets/images/grocery/product/personal-care/8.png"
                                                     class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="-1">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="-1">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="-1">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <h5 class="name text-title">Hair Oil</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="-1">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="-1">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="-1">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="-1">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide" style="width: 216px;" data-slick-index="0" aria-hidden="true"
                                     tabindex="-1">
                                    <div class="product-box-4 wow fadeInUp"
                                         style="visibility: visible; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <img src="../assets/images/grocery/product/personal-care/1.png"
                                                     class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="-1">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="-1">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="-1">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <h5 class="name text-title">Dove men care</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="-1">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="-1">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="-1">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="-1">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide" style="width: 216px;" data-slick-index="1" aria-hidden="true"
                                     tabindex="-1">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.05s"
                                         style="visibility: visible; animation-delay: 0.05s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <img src="../assets/images/grocery/product/personal-care/2.png"
                                                     class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="-1">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="-1">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="-1">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <h5 class="name text-title">Santoor</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="-1">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="-1">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="-1">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="-1">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide slick-current slick-active" style="width: 216px;"
                                     data-slick-index="2" aria-hidden="false" tabindex="0">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.1s"
                                         style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="0">
                                                <img src="../assets/images/grocery/product/personal-care/3.png"
                                                     class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="0">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="0">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="0">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="0">
                                                <h5 class="name text-title">Hand Wash</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="0">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="0">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="0">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="0">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide slick-active" style="width: 216px;" data-slick-index="3"
                                     aria-hidden="false" tabindex="0">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.15s"
                                         style="visibility: visible; animation-delay: 0.15s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="0">
                                                <img src="../assets/images/grocery/product/personal-care/4.png"
                                                     class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="0">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="0">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="0">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="0">
                                                <h5 class="name text-title">Whisper</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="0">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="0">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="0">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="0">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide slick-active" style="width: 216px;" data-slick-index="4"
                                     aria-hidden="false" tabindex="0">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.2s"
                                         style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="0">
                                                <img src="../assets/images/grocery/product/personal-care/5.png"
                                                     class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="0">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="0">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="0">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="0">
                                                <h5 class="name text-title">Whisper</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="0">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="0">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="0">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="0">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide slick-active" style="width: 216px;" data-slick-index="5"
                                     aria-hidden="false" tabindex="0">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.25s"
                                         style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="0">
                                                <img src="../assets/images/grocery/product/personal-care/6.png"
                                                     class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="0">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="0">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="0">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="0">
                                                <h5 class="name text-title">Hair Color</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="0">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="0">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="0">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="0">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide slick-active" style="width: 216px;" data-slick-index="6"
                                     aria-hidden="false" tabindex="0">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.3s"
                                         style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="0">
                                                <img src="../assets/images/grocery/product/personal-care/7.png"
                                                     class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="0">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="0">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="0">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="0">
                                                <h5 class="name text-title">Face Wash</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="0">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="0">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="0">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="0">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide slick-active" style="width: 216px;" data-slick-index="7"
                                     aria-hidden="false" tabindex="0">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.35s"
                                         style="visibility: visible; animation-delay: 0.35s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="0">
                                                <img src="../assets/images/grocery/product/personal-care/8.png"
                                                     class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="0">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="0">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="0">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="0">
                                                <h5 class="name text-title">Hair Oil</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="0">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="0">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="0">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="0">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 216px;" data-slick-index="8" id=""
                                     aria-hidden="true" tabindex="-1">
                                    <div class="product-box-4 wow fadeInUp"
                                         style="visibility: visible; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <img src="../assets/images/grocery/product/personal-care/1.png"
                                                     class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="-1">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="-1">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="-1">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <h5 class="name text-title">Dove men care</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="-1">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="-1">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="-1">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="-1">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 216px;" data-slick-index="9" id=""
                                     aria-hidden="true" tabindex="-1">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.05s"
                                         style="visibility: visible; animation-delay: 0.05s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <img src="../assets/images/grocery/product/personal-care/2.png"
                                                     class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="-1">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="-1">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="-1">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <h5 class="name text-title">Santoor</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="-1">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="-1">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="-1">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="-1">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 216px;" data-slick-index="10" id=""
                                     aria-hidden="true" tabindex="-1">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.1s"
                                         style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <img src="../assets/images/grocery/product/personal-care/3.png"
                                                     class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="-1">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="-1">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="-1">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <h5 class="name text-title">Hand Wash</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="-1">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="-1">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="-1">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="-1">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 216px;" data-slick-index="11" id=""
                                     aria-hidden="true" tabindex="-1">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.15s"
                                         style="visibility: visible; animation-delay: 0.15s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <img src="../assets/images/grocery/product/personal-care/4.png"
                                                     class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="-1">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="-1">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="-1">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <h5 class="name text-title">Whisper</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="-1">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="-1">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="-1">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="-1">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 216px;" data-slick-index="12" id=""
                                     aria-hidden="true" tabindex="-1">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.2s"
                                         style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <img src="../assets/images/grocery/product/personal-care/5.png"
                                                     class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="-1">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="-1">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="-1">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <h5 class="name text-title">Whisper</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="-1">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="-1">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="-1">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="-1">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 216px;" data-slick-index="13" id=""
                                     aria-hidden="true" tabindex="-1">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.25s"
                                         style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <img src="../assets/images/grocery/product/personal-care/6.png"
                                                     class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="-1">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="-1">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="-1">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <h5 class="name text-title">Hair Color</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="-1">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="-1">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="-1">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="-1">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 216px;" data-slick-index="14" id=""
                                     aria-hidden="true" tabindex="-1">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.3s"
                                         style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <img src="../assets/images/grocery/product/personal-care/7.png"
                                                     class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="-1">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="-1">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="-1">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <h5 class="name text-title">Face Wash</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="-1">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="-1">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="-1">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="-1">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-slide slick-cloned" style="width: 216px;" data-slick-index="15" id=""
                                     aria-hidden="true" tabindex="-1">
                                    <div class="product-box-4 wow fadeInUp" data-wow-delay="0.35s"
                                         style="visibility: visible; animation-delay: 0.35s; animation-name: fadeInUp;">
                                        <div class="product-image product-image-2">
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <img src="../assets/images/grocery/product/personal-care/8.png"
                                                     class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <ul class="option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Quick View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                       data-bs-target="#view" tabindex="-1">
                                                        <i class="iconly-Show icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Wishlist">
                                                    <a href="javascript:void(0)" class="notifi-wishlist" tabindex="-1">
                                                        <i class="iconly-Heart icli"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Compare">
                                                    <a href="compare.html" tabindex="-1">
                                                        <i class="iconly-Swap icli"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="product-detail">
                                            <ul class="rating">
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star fill">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </li>
                                            </ul>
                                            <a href="product-left-thumbnail.html" tabindex="-1">
                                                <h5 class="name text-title">Hair Oil</h5>
                                            </a>
                                            <h5 class="price theme-color">$65.21
                                                <del>$71.25</del>
                                            </h5>
                                            <div class="addtocart_btn">
                                                <button class="add-button addcart-button btn buy-button text-light"
                                                        tabindex="-1">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                                <div class="qty-box cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="" tabindex="-1">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="1" tabindex="-1">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="" tabindex="-1">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="slick-next slick-arrow" aria-label="Next" type="button" style="">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="banner-section">
        <div class="container-fluid-lg">
            <div class="row gy-lg-0 gy-3">
                <div class="col-lg-6">
                    <div class="banner-contain-3 hover-effect">
                        <div class="bg-size blur-up lazyloaded"
                             style="background-image: url(&quot;../assets/images/grocery/banner/6.jpg&quot;); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;">
                            <img src="../assets/images/grocery/banner/6.jpg" class="bg-img blur-up lazyload" alt=""
                                 style="display: none;">
                            <div
                                class="banner-detail banner-detail-2 text-dark p-center-left w-75 banner-p-sm position-relative mend-auto">
                                <div>
                                    <h2 class="text-great fw-normal text-danger">50% special offer</h2>
                                    <h3 class="mb-1 fw-bold">Chocolate Shake Back in <br class="d-sm-block d-none">
                                        Stock</h3>
                                    <h4 class="text-content">Offer Of the Week!</h4>
                                    <button class="btn btn-md theme-bg-color text-white mt-sm-3 mt-1 fw-bold mend-auto"
                                            onclick="location.href = 'shop-left-sidebar.html';">Shop Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="banner-contain-3 hover-effect bg-size blur-up lazyloaded"
                         style="background-image: url(&quot;../assets/images/grocery/banner/7.jpg&quot;); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;">
                        <img src="../assets/images/grocery/banner/7.jpg" class="bg-img blur-up lazyload" alt=""
                             style="display: none;">
                        <div
                            class="banner-detail banner-detail-2 text-dark p-center-left w-75 banner-p-sm position-relative mend-auto">
                            <div>
                                <h2 class="text-great fw-normal text-danger">Special hot sale</h2>
                                <h3 class="mb-1 fw-bold">Healthy &amp; Fresh Cool <br> Breakfast</h3>
                                <h4 class="text-content">Choose a Nutritious &amp; Healthy Breakfast.</h4>
                                <button class="btn btn-md theme-bg-color text-white mt-sm-3 mt-1 fw-bold mend-auto"
                                        onclick="location.href = 'shop-left-sidebar.html';">Shop Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="blog-section">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Artikel Terbaru</h2>
            </div>

            <div class="row">
                @foreach(ArticleHelper::topArticles(10) as $article)
                    <div class="col-12 col-md-4">
                        <div class="blog-box ratio_50">
                            <div class="blog-box-image">
                                <a href="{{ route('home.articles.show', $article->slug) }}" tabindex="-1"
                                   class="bg-size"
                                   style="background-image: url(&quot;../assets/images/veg-3/blog/2.jpg&quot;); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;">
                                    <img src="{{ asset('storage/' . $article->photo) }}" class="img-fluid bg-img"
                                         alt="{{ $article->title }}"
                                         style="display: none;">
                                </a>
                            </div>

                            <div class="blog-detail">
                                <label>{{ $article->category->name }}</label>
                                <a href="{{ route('home.articles.show', $article->slug) }}" tabindex="-1">
                                    <h2>{{ (strlen($article->title) > 25) ? substr($article->title, 0, 30) . "..." : $article->title }}</h2>
                                </a>
                                <div class="blog-list">
                                    <span>{{ Carbon::parse($article->created_at)->translatedFormat('d F Y') }}</span>
                                    <span>Oleh : {{ $article->user->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
