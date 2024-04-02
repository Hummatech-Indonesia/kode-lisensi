@php
    use App\Enums\ProductStatusEnum;
    use App\Enums\UserRoleEnum;
    use App\Helpers\ArticleHelper;
    use App\Helpers\CurrencyHelper;
    use App\Helpers\RatingHelper;
    use App\Helpers\UserHelper;
    use Carbon\Carbon;
@endphp
@section('asset')
    <style>
        .product-box-3 .product-footer .price del {
            margin-left: 0 !important;
        }

        .blog-description {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 3;
        }
    </style>
@endsection
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
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
                                <img src="{{ asset('storage/' . $slider->image) }}" class="img-fluid bg-img blur-up lazyload"
                                    alt="{{ $slider->offer }}">
                                <div class="home-detail home-big-space p-center-left home-overlay position-relative">
                                    <div class="container-fluid-lg">
                                        <div>
                                            <h6 class="ls-expanded theme-color text-uppercase">{{ $slider->offer }}
                                            </h6>
                                            <h1 class="heding-2">{{ $slider->header }}</h1>
                                            <h2 class="content-2">{{ $slider->sub_header }}</h2>
                                            <h5 class="text-content">{{ $slider->description }}
                                            </h5>
                                            <button
                                                class="btn theme-bg-color btn-md text-white fw-bold mt-md-4 mt-2 mend-auto"
                                                onclick="location.href = '{{ $slider->product_url }}';">Lihat Sekarang
                                                <i class="fa-solid fa-arrow-right icon"></i>
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
    <!-- Home Section End -->

    {{-- Rekomendasi Produk --}}
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-12 col-xl-12">
                    <div class="title title-flex">
                        <div>
                            <h2>Rekomendasi Produk</h2>
                            <span class="title-leaf">
                                <svg class="icon-width">
                                    <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                </svg>
                            </span>
                            <p>Produk-produk yang kami rekomendasikan</p>
                        </div>
                    </div>
                    <div id="productContainer"
                        class="row g-sm-4 g-3 product-list-section row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 mt-3 mb-5">
                        @forelse ($productRecommendation as $product)
                            <div class="loopProducts">
                                <div class="product-box-3 h-100 wow fadeInUp"
                                    style="visibility: visible; animation-name: fadeInUp;">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="{{ route('home.products.show', $product->slug) }}">
                                                <img src="{{ asset('storage/' . $product->photo) }}"
                                                    class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Lihat Produk">
                                                    <a href="{{ route('home.products.show', $product->slug) }}">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-original-title="Bagikan Produk">
                                                    @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                        <a href="#">
                                                            <i data-feather="share-2" data-bs-toggle="modal"
                                                                data-bs-target="#shareProductModal"
                                                                data-slug="{{ $product->slug }}" id="shareButtonsTrigger"
                                                                data-code="{{ auth()->user()->code_affiliate }}"></i>
                                                        </a>
                                                    @else
                                                        <a href="#">
                                                            <i data-feather="share-2" data-bs-toggle="modal"
                                                                data-bs-target="#shareProductModal"
                                                                data-slug="{{ $product->slug }}"
                                                                id="shareButtonsTrigger"></i>
                                                        </a>
                                                    @endif
                                                </li>

                                                @auth
                                                    @if ($product->product_favorites->where('user_id', auth()->user()->id)->first())
                                                        <li data-bs-toggle="tooltip" class="favorite" data-bs-placement="top"
                                                            title="" data-bs-original-title="Favorit">
                                                            <a href="" class="delete-favorite"
                                                                data-id="{{ $product->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" style="color: red" fill="currentColor"
                                                                    class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1" />
                                                                </svg>
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                            data-bs-original-title="Favorit">
                                                            <a href="" class="add-favorite"
                                                                data-id="{{ $product->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-suit-heart"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z" />
                                                                </svg>

                                                            </a>
                                                        </li>
                                                    @endif
                                                @endauth
                                                @guest
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Favorit">
                                                        <a href="/login" class="add-favorite" data-id="{{ $product->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-suit-heart"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z" />
                                                            </svg>

                                                        </a>
                                                    </li>
                                                @endguest
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <h4><a
                                                    href="{{ route('home.category', $product->category->id) }}">{{ $product->category->name }}</a>
                                            </h4>
                                            <a href="{{ route('home.products.show', $product->slug) }}">
                                                <h3 class="name mb-1">{{ $product->name }}</h3>
                                            </a>
                                            @auth
                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                    <h4 class="badge bg-warning">Discount:
                                                        {{ $product->reseller_discount }}%</h4>
                                                @else
                                                    <h4><span class="badge bg-warning">Discount:
                                                            {{ $product->discount }}%</span></h4>
                                                @endif
                                            @else
                                                <h4><span class="badge bg-warning">Discount: {{ $product->discount }}%</span>
                                                </h4>
                                            @endauth


                                            <h5 class="price">
                                                @if ($product->varianProducts->isEmpty())
                                                    @auth
                                                        @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                            @if ($product->reseller_discount)
                                                                <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                            @endif
                                                            <h4 class="theme-color fw-bold">
                                                                {{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->reseller_discount, true) }}
                                                            </h4>
                                                        @else
                                                            @if ($product->discount)
                                                                <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                            @endif
                                                            <h4 class="theme-color fw-bold">
                                                                {{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}
                                                            </h4>
                                                        @endif
                                                    @else
                                                        @if ($product->discount)
                                                            <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                        @endif
                                                        <h4 class="theme-color fw-bold">
                                                            {{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}
                                                        </h4>
                                                    @endauth
                                                @else
                                                    @auth
                                                        @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                            @if ($product->reseller_discount != 0)
                                                                <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($product->varianProducts)) }}</del>
                                                                -
                                                                <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($product->varianProducts)) }}</del>
                                                            @endif
                                                            <h4 class="theme-color fw-bold">
                                                                {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($product->varianProducts), $product->reseller_discount)) }}
                                                                -
                                                                {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($product->varianProducts), $product->reseller_discount)) }}
                                                            </h4>
                                                        @else
                                                            @if ($product->discount != 0)
                                                                <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($product->varianProducts)) }}
                                                                    -
                                                                    {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($product->varianProducts)) }}</del>
                                                            @endif
                                                            <h4 class="theme-color fw-bold">
                                                                {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($product->varianProducts), $product->discount, true) }}
                                                                -
                                                                {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($product->varianProducts), $product->discount, true) }}
                                                            </h4>
                                                        @endif
                                                    @else
                                                        @if ($product->discount != 0)
                                                            <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($product->varianProducts)) }}
                                                                -
                                                                {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($product->varianProducts)) }}</del>
                                                        @endif
                                                        <h4 class="theme-color fw-bold">
                                                            {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($product->varianProducts), $product->discount)) }}
                                                            -
                                                            {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($product->varianProducts), $product->discount, true) }}
                                                        </h4>
                                                    @endauth
                                                @endif

                                            </h5>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <li>
                                                            @if ($i <= RatingHelper::sumProductRatings($product->id)['stars'])
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-star fill">
                                                                    <polygon
                                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                                    </polygon>
                                                                </svg>
                                                            @else
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-star">
                                                                    <polygon
                                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                                    </polygon>
                                                                </svg>
                                                            @endif
                                                        </li>
                                                    @endfor

                                                </ul>
                                                @if (RatingHelper::sumProductRatings($product->id)['sumRating'] == 0)
                                                    <span>(Belum ada ulasan)</span>
                                                @else
                                                    <span>{{ RatingHelper::sumProductRatings($product->id)['sumRating'] }}
                                                        ({{ $product->product_ratings_count }} ulasan)
                                                    </span>
                                                @endif

                                            </div>
                                            <h6 class="unit">
                                                @if ($product->status === ProductStatusEnum::AVAILABLE->value)
                                                    @if ($product->licenses_count > 0)
                                                        <h4>
                                                            <span class="badge rounded-pill text-bg-success"> Tersedia:
                                                                {{ $product->licenses_count }} Stok</span>
                                                        </h4>
                                                    @else
                                                        <h4>
                                                            <span class="badge rounded-pill text-bg-danger">Produk telah
                                                                habis</span>
                                                        </h4>
                                                    @endif
                                                @else
                                                    <h4>
                                                        <span
                                                            class="badge rounded-pill text-bg-info text-white">Preorder</span>
                                                    </h4>
                                                @endif
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Tidak ada produk direkomendasikan</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-12 col-xl-12">
                    <div class="title title-flex">
                        <div>
                            <h2>Produk Terlaris</h2>
                            <span class="title-leaf">
                                <svg class="icon-width">
                                    <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                </svg>
                            </span>
                            <p>Produk dengan jumlah pembelian terbanyak dan paling sering dibeli</p>
                        </div>
                    </div>
                    <div id="productContainer"
                        class="row g-sm-4 g-3 product-list-section row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 mt-3 mb-5">
                        @foreach ($bestSellerProductPage as $product)
                            <div class="loopProducts">
                                <div class="product-box-3 h-100 wow fadeInUp"
                                    style="visibility: visible; animation-name: fadeInUp;">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="{{ route('home.products.show', $product->slug) }}">
                                                <img src="{{ asset('storage/' . $product->photo) }}"
                                                    class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Lihat Produk">
                                                    <a href="{{ route('home.products.show', $product->slug) }}">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-original-title="Bagikan Produk">
                                                    @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                        <a href="#" onclick="return false;">
                                                            <i data-feather="share-2" data-bs-toggle="modal"
                                                                data-bs-target="#shareProductModal"
                                                                data-slug="{{ $product->slug }}" id="shareButtonsTrigger"
                                                                data-code="{{ auth()->user()->code_affiliate }}"></i>
                                                        </a>
                                                    @else
                                                        <a href="#" onclick="return false;">
                                                            <i data-feather="share-2" data-bs-toggle="modal"
                                                                data-bs-target="#shareProductModal"
                                                                data-slug="{{ $product->slug }}"
                                                                id="shareButtonsTrigger"></i>
                                                        </a>
                                                    @endif
                                                </li>

                                                @auth
                                                    @if ($product->product_favorites->where('user_id', auth()->user()->id)->first())
                                                        <li data-bs-toggle="tooltip" class="favorite" data-bs-placement="top"
                                                            title="" data-bs-original-title="Favorit">
                                                            <a href="" class="delete-favorite"
                                                                data-id="{{ $product->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" style="color: red" fill="currentColor"
                                                                    class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1" />
                                                                </svg>
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                            data-bs-original-title="Favorit">
                                                            <a href="" class="add-favorite"
                                                                data-id="{{ $product->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-suit-heart" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z" />
                                                                </svg>

                                                            </a>
                                                        </li>
                                                    @endif
                                                @endauth
                                                @guest
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Favorit">
                                                        <a href="/login" class="add-favorite"
                                                            data-id="{{ $product->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-suit-heart"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z" />
                                                            </svg>

                                                        </a>
                                                    </li>
                                                @endguest
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <h4><a
                                                    href="{{ route('home.category', $product->category->id) }}">{{ $product->category->name }}</a>
                                            </h4>
                                            <a href="{{ route('home.products.show', $product->slug) }}">
                                                <h3 class="name mb-1">{{ $product->name }}</h3>
                                            </a>
                                            @auth
                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                    <h4 class="badge bg-warning">Discount:
                                                        {{ $product->reseller_discount }}%</h4>
                                                @else
                                                    <h4><span class="badge bg-warning">Discount:
                                                            {{ $product->discount }}%</span></h4>
                                                @endif
                                            @else
                                                <h4><span class="badge bg-warning">Discount: {{ $product->discount }}%</span>
                                                </h4>
                                            @endauth


                                            <h5 class="price">
                                                @if ($product->varianProducts->isEmpty())
                                                    @auth
                                                        @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                            @if ($product->reseller_discount)
                                                                <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                            @endif
                                                            <h4 class="theme-color fw-bold">
                                                                {{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->reseller_discount, true) }}
                                                            </h4>
                                                        @else
                                                            @if ($product->discount)
                                                                <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                            @endif
                                                            <h4 class="theme-color fw-bold">
                                                                {{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}
                                                            </h4>
                                                        @endif
                                                    @else
                                                        @if ($product->discount)
                                                            <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                        @endif
                                                        <h4 class="theme-color fw-bold">
                                                            {{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}
                                                        </h4>
                                                    @endauth
                                                @else
                                                    @auth
                                                        @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                            @if ($product->reseller_discount != 0)
                                                                <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($product->varianProducts)) }}</del>
                                                                -
                                                                <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($product->varianProducts)) }}</del>
                                                            @endif
                                                            <h4 class="theme-color fw-bold">
                                                                {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($product->varianProducts), $product->reseller_discount)) }}
                                                                -
                                                                {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($product->varianProducts), $product->reseller_discount)) }}
                                                            </h4>
                                                        @else
                                                            @if ($product->discount != 0)
                                                                <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($product->varianProducts)) }}
                                                                    -
                                                                    {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($product->varianProducts)) }}</del>
                                                            @endif
                                                            <h4 class="theme-color fw-bold">
                                                                {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($product->varianProducts), $product->discount, true) }}
                                                                -
                                                                {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($product->varianProducts), $product->discount, true) }}
                                                            </h4>
                                                        @endif
                                                    @else
                                                        @if ($product->discount != 0)
                                                            <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($product->varianProducts)) }}
                                                                -
                                                                {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($product->varianProducts)) }}</del>
                                                        @endif
                                                        <h4 class="theme-color fw-bold">
                                                            {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($product->varianProducts), $product->discount)) }}
                                                            -
                                                            {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($product->varianProducts), $product->discount, true) }}
                                                        </h4>
                                                    @endauth
                                                @endif

                                            </h5>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <li>
                                                            @if ($i <= RatingHelper::sumProductRatings($product->id)['stars'])
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-star fill">
                                                                    <polygon
                                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                                    </polygon>
                                                                </svg>
                                                            @else
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-star">
                                                                    <polygon
                                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                                    </polygon>
                                                                </svg>
                                                            @endif
                                                        </li>
                                                    @endfor

                                                </ul>
                                                @if (RatingHelper::sumProductRatings($product->id)['sumRating'] == 0)
                                                    <span>(Belum ada ulasan)</span>
                                                @else
                                                    <span>{{ RatingHelper::sumProductRatings($product->id)['sumRating'] }}
                                                        ({{ $product->product_ratings_count }} ulasan)
                                                    </span>
                                                @endif

                                            </div>
                                            <h6 class="unit">
                                                @if ($product->status === ProductStatusEnum::AVAILABLE->value)
                                                    @if ($product->licenses_count > 0)
                                                        <h4>
                                                            <span class="badge rounded-pill text-bg-success"> Tersedia:
                                                                {{ $product->licenses_count }} Stok</span>
                                                        </h4>
                                                    @else
                                                        <h4>
                                                            <span class="badge rounded-pill text-bg-danger">Produk telah
                                                                habis</span>
                                                        </h4>
                                                    @endif
                                                @else
                                                    <h4>
                                                        <span
                                                            class="badge rounded-pill text-bg-info text-white">Preorder</span>
                                                    </h4>
                                                @endif
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if (count($bestSellerProductPage) <= 8)
                            @if (count($latestProductNotBestSellers) >= 8 - count($bestSellerProductPage))
                                @for ($i = 0; $i < 8 - count($bestSellerProductPage); $i++)
                                    <div class="loopProducts" id="latestProduct">
                                        <div class="product-box-3 h-100 wow fadeInUp"
                                            style="visibility: visible; animation-name: fadeInUp;">
                                            <div class="product-header">
                                                <div class="product-image">
                                                    <a
                                                        href="{{ route('home.products.show', $latestProductNotBestSellers[$i]->slug) }}">
                                                        <img src="{{ asset('storage/' . $latestProductNotBestSellers[$i]->photo) }}"
                                                            class="img-fluid blur-up lazyloaded" alt="">
                                                    </a>
                                                    <ul class="product-option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="" data-bs-original-title="Lihat Produk">
                                                            <a
                                                                href="{{ route('home.products.show', $latestProductNotBestSellers[$i]->slug) }}">
                                                                <i data-feather="eye"></i>
                                                            </a>
                                                        </li>

                                                        <li data-bs-toggle="tooltip"
                                                            data-bs-original-title="Bagikan Produk">
                                                            @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                                <a href="#" onclick="return false;">
                                                                    <i data-feather="share-2" data-bs-toggle="modal"
                                                                        data-bs-target="#shareProductModal"
                                                                        data-slug="{{ $latestProductNotBestSellers[$i]->slug }}"
                                                                        id="shareButtonsTrigger"
                                                                        data-code="{{ auth()->user()->code_affiliate }}"></i>
                                                                </a>
                                                            @else
                                                                <a href="#" onclick="return false;">
                                                                    <i data-feather="share-2" data-bs-toggle="modal"
                                                                        data-bs-target="#shareProductModal"
                                                                        data-slug="{{ $latestProductNotBestSellers[$i]->slug }}"
                                                                        id="shareButtonsTrigger"></i>
                                                                </a>
                                                            @endif
                                                        </li>
                                                        @auth
                                                            @if ($latestProductNotBestSellers[$i]->product_favorites->where('user_id', auth()->user()->id)->first())
                                                                <li data-bs-toggle="tooltip" class="favorite"
                                                                    data-bs-placement="top" title=""
                                                                    data-bs-original-title="Favorit">
                                                                    <a href="" class="delete-favorite"
                                                                        data-id="{{ $latestProductNotBestSellers[$i]->id }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                            height="16" style="color: red"
                                                                            fill="currentColor" class="bi bi-suit-heart-fill"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1" />
                                                                        </svg>
                                                                    </a>
                                                                </li>
                                                            @else
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="" data-bs-original-title="Favorit">
                                                                    <a href="" class="add-favorite"
                                                                        data-id="{{ $latestProductNotBestSellers[$i]->id }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                            height="16" fill="currentColor"
                                                                            class="bi bi-suit-heart" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z" />
                                                                        </svg>

                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endauth
                                                        @guest
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="" data-bs-original-title="Favorit">
                                                                <a href="/login" class="add-favorite"
                                                                    data-id="{{ $latestProductNotBestSellers[$i]->id }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-suit-heart" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z" />
                                                                    </svg>

                                                                </a>
                                                            </li>
                                                        @endguest
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-footer">
                                                <div class="product-detail">
                                                    <h4><a
                                                            href="{{ route('home.category', $latestProductNotBestSellers[$i]->category->id) }}">{{ $latestProductNotBestSellers[$i]->category->name }}</a>
                                                    </h4>
                                                    <a
                                                        href="{{ route('home.products.show', $latestProductNotBestSellers[$i]->slug) }}">
                                                        <h3 class="name mb-1">
                                                            {{ $latestProductNotBestSellers[$i]->name }}</h3>
                                                    </a>
                                                    @auth
                                                        @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                            <h4 class="badge bg-warning">Discount:
                                                                {{ $latestProductNotBestSellers[$i]->reseller_discount }}%
                                                            </h4>
                                                        @else
                                                            <h4><span class="badge bg-warning">Discount:
                                                                    {{ $latestProductNotBestSellers[$i]->discount }}%</span>
                                                            </h4>
                                                        @endif
                                                    @else
                                                        <h4><span class="badge bg-warning">Discount:
                                                                {{ $latestProductNotBestSellers[$i]->discount }}%</span>
                                                        </h4>
                                                    @endauth

                                                    <h5 class="price">
                                                        @if ($latestProductNotBestSellers[$i]->varianProducts->isEmpty())
                                                            @auth
                                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                                    @if ($latestProductNotBestSellers[$i]->reseller_discount)
                                                                        <del>{{ CurrencyHelper::rupiahCurrency($latestProductNotBestSellers[$i]->sell_price) }}</del>
                                                                    @endif
                                                                    <h4 class="theme-color fw-bold">
                                                                        {{ CurrencyHelper::countPriceAfterDiscount($latestProductNotBestSellers[$i]->sell_price, $latestProductNotBestSellers[$i]->reseller_discount, true) }}
                                                                    </h4>
                                                                @else
                                                                    @if ($latestProductNotBestSellers[$i]->discount)
                                                                        <del>{{ CurrencyHelper::rupiahCurrency($latestProductNotBestSellers[$i]->sell_price) }}</del>
                                                                    @endif
                                                                    <h4 class="theme-color fw-bold">
                                                                        {{ CurrencyHelper::countPriceAfterDiscount($latestProductNotBestSellers[$i]->sell_price, $latestProductNotBestSellers[$i]->discount, true) }}
                                                                    </h4>
                                                                @endif
                                                            @else
                                                                @if ($latestProductNotBestSellers[$i]->discount)
                                                                    <del>{{ CurrencyHelper::rupiahCurrency($latestProductNotBestSellers[$i]->sell_price) }}</del>
                                                                @endif
                                                                <h4 class="theme-color fw-bold">
                                                                    {{ CurrencyHelper::countPriceAfterDiscount($latestProductNotBestSellers[$i]->sell_price, $latestProductNotBestSellers[$i]->discount, true) }}
                                                                </h4>
                                                            @endauth
                                                        @else
                                                            @auth
                                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                                    @if ($latestProductNotBestSellers[$i]->reseller_discount != 0)
                                                                        <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($latestProductNotBestSellers[$i]->varianProducts)) }}</del>
                                                                        -
                                                                        <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($latestProductNotBestSellers[$i]->varianProducts)) }}</del>
                                                                    @endif
                                                                    <h4 class="theme-color fw-bold">
                                                                        {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($latestProductNotBestSellers[$i]->varianProducts), $latestProductNotBestSellers[$i]->reseller_discount)) }}
                                                                        -
                                                                        {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($latestProductNotBestSellers[$i]->varianProducts), $latestProductNotBestSellers[$i]->reseller_discount)) }}
                                                                    </h4>
                                                                @else
                                                                    @if ($latestProductNotBestSellers[$i]->discount != 0)
                                                                        <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($latestProductNotBestSellers[$i]->varianProducts)) }}
                                                                            -
                                                                            {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($latestProductNotBestSellers[$i]->varianProducts)) }}</del>
                                                                    @endif
                                                                    <h4 class="theme-color fw-bold">
                                                                        {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($latestProductNotBestSellers[$i]->varianProducts), $latestProductNotBestSellers[$i]->discount, true) }}
                                                                        -
                                                                        {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($latestProductNotBestSellers[$i]->varianProducts), $latestProductNotBestSellers[$i]->discount, true) }}
                                                                    </h4>
                                                                @endif
                                                            @else
                                                                @if ($latestProductNotBestSellers[$i]->discount != 0)
                                                                    <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($latestProductNotBestSellers[$i]->varianProducts)) }}
                                                                        -
                                                                        {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($latestProductNotBestSellers[$i]->varianProducts)) }}</del>
                                                                @endif
                                                                <h4 class="theme-color fw-bold">
                                                                    {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($latestProductNotBestSellers[$i]->varianProducts), $latestProductNotBestSellers[$i]->discount)) }}
                                                                    -
                                                                    {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($latestProductNotBestSellers[$i]->varianProducts), $latestProductNotBestSellers[$i]->discount, true) }}
                                                                </h4>
                                                            @endauth
                                                        @endif

                                                    </h5>
                                                    <div class="product-rating mt-2">
                                                        <ul class="rating">
                                                            @for ($j = 1; $j <= 5; $j++)
                                                                <li>
                                                                    @if ($j <= RatingHelper::sumProductRatings($latestProductNotBestSellers[$i]->id)['stars'])
                                                                        <i data-feather="star" class="fill"></i>
                                                                    @else
                                                                        <i data-feather="star"></i>
                                                                    @endif
                                                                </li>
                                                            @endfor

                                                        </ul>
                                                        @if (RatingHelper::sumProductRatings($latestProductNotBestSellers[$i]->id)['sumRating'] == 0)
                                                            <span>(Belum ada ulasan)</span>
                                                        @else
                                                            <span>{{ RatingHelper::sumProductRatings($latestProductNotBestSellers[$i]->id)['sumRating'] }}
                                                                ({{ $latestProductNotBestSellers[$i]->product_ratings_count }}
                                                                ulasan)
                                                            </span>
                                                        @endif

                                                    </div>
                                                    <h6 class="unit">
                                                        @if ($latestProductNotBestSellers[$i]->status === ProductStatusEnum::AVAILABLE->value)
                                                            @if ($latestProductNotBestSellers[$i]->licenses_count > 0)
                                                                <h4>
                                                                    <span class="badge rounded-pill text-bg-success">
                                                                        Tersedia:
                                                                        {{ $latestProductNotBestSellers[$i]->licenses_count }}
                                                                        Stok</span>
                                                                </h4>
                                                            @else
                                                                <h4>
                                                                    <span class="badge rounded-pill text-bg-danger">Produk
                                                                        telah
                                                                        habis</span>
                                                                </h4>
                                                            @endif
                                                            <h4>
                                                                <span
                                                                    class="badge rounded-pill text-bg-info text-white">Preorder</span>
                                                            </h4>
                                                        @endif
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @else
                                @for ($i = 0; $i < count($latestProductNotBestSellers); $i++)
                                    <div class="loopProducts" id="latestProduct">
                                        <div class="product-box-3 h-100 wow fadeInUp"
                                            style="visibility: visible; animation-name: fadeInUp;">
                                            <div class="product-header">
                                                <div class="product-image">
                                                    <a
                                                        href="{{ route('home.products.show', $latestProductNotBestSellers[$i]->slug) }}">
                                                        <img src="{{ asset('storage/' . $latestProductNotBestSellers[$i]->photo) }}"
                                                            class="img-fluid blur-up lazyloaded" alt="">
                                                    </a>
                                                    <ul class="product-option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="" data-bs-original-title="Lihat Produk">
                                                            <a
                                                                href="{{ route('home.products.show', $latestProductNotBestSellers[$i]->slug) }}">
                                                                <i data-feather="eye"></i>
                                                            </a>
                                                        </li>

                                                        <li data-bs-toggle="tooltip"
                                                            data-bs-original-title="Bagikan Produk">
                                                            @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                                <a href="#" onclick="return false;">
                                                                    <i data-feather="share-2" data-bs-toggle="modal"
                                                                        data-bs-target="#shareProductModal"
                                                                        data-slug="{{ $latestProductNotBestSellers[$i]->slug }}"
                                                                        id="shareButtonsTrigger"
                                                                        data-code="{{ auth()->user()->code_affiliate }}"></i>
                                                                </a>
                                                            @else
                                                                <a href="#" onclick="return false;">
                                                                    <i data-feather="share-2" data-bs-toggle="modal"
                                                                        data-bs-target="#shareProductModal"
                                                                        data-slug="{{ $latestProductNotBestSellers[$i]->slug }}"
                                                                        id="shareButtonsTrigger"></i>
                                                                </a>
                                                            @endif
                                                        </li>
                                                        @auth
                                                            @if ($latestProductNotBestSellers[$i]->product_favorites->where('user_id', auth()->user()->id)->first())
                                                                <li data-bs-toggle="tooltip" class="favorite"
                                                                    data-bs-placement="top" title=""
                                                                    data-bs-original-title="Favorit">
                                                                    <a href="" class="delete-favorite"
                                                                        data-id="{{ $latestProductNotBestSellers[$i]->id }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                            height="16" style="color: red"
                                                                            fill="currentColor" class="bi bi-suit-heart-fill"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1" />
                                                                        </svg>
                                                                    </a>
                                                                </li>
                                                            @else
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="" data-bs-original-title="Favorit">
                                                                    <a href="" class="add-favorite"
                                                                        data-id="{{ $latestProductNotBestSellers[$i]->id }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                            height="16" fill="currentColor"
                                                                            class="bi bi-suit-heart" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z" />
                                                                        </svg>

                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endauth
                                                        @guest
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="" data-bs-original-title="Favorit">
                                                                <a href="/login" class="add-favorite"
                                                                    data-id="{{ $latestProductNotBestSellers[$i]->id }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-suit-heart" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z" />
                                                                    </svg>

                                                                </a>
                                                            </li>
                                                        @endguest
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-footer">
                                                <div class="product-detail">

                                                    <h4><a
                                                            href="{{ route('home.category', $latestProductNotBestSellers[$i]->category->id) }}">{{ $latestProductNotBestSellers[$i]->category->name }}</a>
                                                    </h4>
                                                    <a
                                                        href="{{ route('home.products.show', $latestProductNotBestSellers[$i]->slug) }}">
                                                        <h3 class="name mb-1">
                                                            {{ $latestProductNotBestSellers[$i]->name }}</h3>
                                                    </a>
                                                    @auth
                                                        @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                            <h4 class="badge bg-warning">Discount:
                                                                {{ $latestProductNotBestSellers[$i]->reseller_discount }}%
                                                            </h4>
                                                        @else
                                                            <h4><span class="badge bg-warning">Discount:
                                                                    {{ $latestProductNotBestSellers[$i]->discount }}%</span>
                                                            </h4>
                                                        @endif
                                                    @else
                                                        <h4><span class="badge bg-warning">Discount:
                                                                {{ $latestProductNotBestSellers[$i]->discount }}%</span>
                                                        </h4>
                                                    @endauth

                                                    <h5 class="price">
                                                        @if ($latestProductNotBestSellers[$i]->varianProducts->isEmpty())
                                                            @auth
                                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                                    @if ($latestProductNotBestSellers[$i]->reseller_discount)
                                                                        <del>{{ CurrencyHelper::rupiahCurrency($latestProductNotBestSellers[$i]->sell_price) }}</del>
                                                                    @endif
                                                                    <h4 class="theme-color fw-bold">
                                                                        {{ CurrencyHelper::countPriceAfterDiscount($latestProductNotBestSellers[$i]->sell_price, $latestProductNotBestSellers[$i]->reseller_discount, true) }}
                                                                    </h4>
                                                                @else
                                                                    @if ($latestProductNotBestSellers[$i]->discount)
                                                                        <del>{{ CurrencyHelper::rupiahCurrency($latestProductNotBestSellers[$i]->sell_price) }}</del>
                                                                    @endif
                                                                    <h4 class="theme-color fw-bold">
                                                                        {{ CurrencyHelper::countPriceAfterDiscount($latestProductNotBestSellers[$i]->sell_price, $latestProductNotBestSellers[$i]->discount, true) }}
                                                                    </h4>
                                                                @endif
                                                            @else
                                                                @if ($latestProductNotBestSellers[$i]->discount)
                                                                    <del>{{ CurrencyHelper::rupiahCurrency($latestProductNotBestSellers[$i]->sell_price) }}</del>
                                                                @endif
                                                                <h4 class="theme-color fw-bold">
                                                                    {{ CurrencyHelper::countPriceAfterDiscount($latestProductNotBestSellers[$i]->sell_price, $latestProductNotBestSellers[$i]->discount, true) }}
                                                                </h4>
                                                            @endauth
                                                        @else
                                                            @auth
                                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                                    @if ($latestProductNotBestSellers[$i]->reseller_discount != 0)
                                                                        <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($latestProductNotBestSellers[$i]->varianProducts)) }}</del>
                                                                        -
                                                                        <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($latestProductNotBestSellers[$i]->varianProducts)) }}</del>
                                                                    @endif
                                                                    <h4 class="theme-color fw-bold">
                                                                        {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($latestProductNotBestSellers[$i]->varianProducts), $latestProductNotBestSellers[$i]->reseller_discount)) }}
                                                                        -
                                                                        {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($latestProductNotBestSellers[$i]->varianProducts), $latestProductNotBestSellers[$i]->reseller_discount)) }}
                                                                    </h4>
                                                                @else
                                                                    @if ($latestProductNotBestSellers[$i]->discount != 0)
                                                                        <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($latestProductNotBestSellers[$i]->varianProducts)) }}
                                                                            -
                                                                            {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($latestProductNotBestSellers[$i]->varianProducts)) }}</del>
                                                                    @endif
                                                                    <h4 class="theme-color fw-bold">
                                                                        {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($latestProductNotBestSellers[$i]->varianProducts), $latestProductNotBestSellers[$i]->discount, true) }}
                                                                        -
                                                                        {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($latestProductNotBestSellers[$i]->varianProducts), $latestProductNotBestSellers[$i]->discount, true) }}
                                                                    </h4>
                                                                @endif
                                                            @else
                                                                @if ($latestProductNotBestSellers[$i]->discount != 0)
                                                                    <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($latestProductNotBestSellers[$i]->varianProducts)) }}
                                                                        -
                                                                        {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($latestProductNotBestSellers[$i]->varianProducts)) }}</del>
                                                                @endif
                                                                <h4 class="theme-color fw-bold">
                                                                    {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($latestProductNotBestSellers[$i]->varianProducts), $latestProductNotBestSellers[$i]->discount)) }}
                                                                    -
                                                                    {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($latestProductNotBestSellers[$i]->varianProducts), $latestProductNotBestSellers[$i]->discount, true) }}
                                                                </h4>
                                                            @endauth
                                                        @endif

                                                    </h5>
                                                    <div class="product-rating mt-2">
                                                        <ul class="rating">
                                                            @for ($j = 1; $j <= 5; $j++)
                                                                <li>
                                                                    @if ($j <= RatingHelper::sumProductRatings($latestProductNotBestSellers[$i]->id)['stars'])
                                                                        <i data-feather="star" class="fill"></i>
                                                                    @else
                                                                        <i data-feather="star"></i>
                                                                    @endif
                                                                </li>
                                                            @endfor

                                                        </ul>
                                                        @if (RatingHelper::sumProductRatings($latestProductNotBestSellers[$i]->id)['sumRating'] == 0)
                                                            <span>(Belum ada ulasan)</span>
                                                        @else
                                                            <span>{{ RatingHelper::sumProductRatings($latestProductNotBestSellers[$i]->id)['sumRating'] }}
                                                                ({{ $latestProductNotBestSellers[$i]->product_ratings_count }}
                                                                ulasan)
                                                            </span>
                                                        @endif

                                                    </div>
                                                    <h6 class="unit">
                                                        @if ($latestProductNotBestSellers[$i]->status === ProductStatusEnum::AVAILABLE->value)
                                                            @if ($latestProductNotBestSellers[$i]->licenses_count > 0)
                                                                <h4>
                                                                    <span class="badge rounded-pill text-bg-success">
                                                                        Tersedia:
                                                                        {{ $latestProductNotBestSellers[$i]->licenses_count }}
                                                                        Stok</span>
                                                                </h4>
                                                            @else
                                                                <h4>
                                                                    <span class="badge rounded-pill text-bg-danger">Produk
                                                                        telah
                                                                        habis</span>
                                                                </h4>
                                                            @endif
                                                        @else
                                                            <h4>
                                                                <span
                                                                    class="badge rounded-pill text-bg-info text-white">Preorder</span>
                                                            </h4>
                                                        @endif
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>



    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-12 col-xl-12">
                    <div class="title title-flex">
                        <div>
                            <h2>Produk Rating Tertinggi</h2>
                            <span class="title-leaf">
                                <svg class="icon-width">
                                    <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                </svg>
                            </span>
                            <p>Produk pilihan dengan jumlah rating tertinggi oleh para pelanggan.</p>
                        </div>
                    </div>
                    <div id="productContainer"
                        class="row g-sm-4 g-3 product-list-section row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 mt-3 mb-5">
                        @foreach ($highestRatingProducts as $product)
                            <div class="loopProducts">
                                <div class="product-box-3 h-100 wow fadeInUp"
                                    style="visibility: visible; animation-name: fadeInUp;">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="{{ route('home.products.show', $product->slug) }}">
                                                <img src="{{ asset('storage/' . $product->photo) }}"
                                                    class="img-fluid blur-up lazyloaded" alt="">
                                            </a>

                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Lihat Produk">
                                                    <a href="{{ route('home.products.show', $product->slug) }}">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-original-title="Bagikan Produk">
                                                    @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                        <a href="#" onclick="return false;">
                                                            <i data-feather="share-2" data-bs-toggle="modal"
                                                                data-bs-target="#shareProductModal"
                                                                data-slug="{{ $product->slug }}"
                                                                id="shareButtonsTrigger"
                                                                data-code="{{ auth()->user()->code_affiliate }}"></i>
                                                        </a>
                                                    @else
                                                        <a href="#" onclick="return false;">
                                                            <i data-feather="share-2" data-bs-toggle="modal"
                                                                data-bs-target="#shareProductModal"
                                                                data-slug="{{ $product->slug }}"
                                                                id="shareButtonsTrigger"></i>
                                                        </a>
                                                    @endif
                                                </li>

                                                @auth
                                                    @if ($product->product_favorites->where('user_id', auth()->user()->id)->first())
                                                        <li data-bs-toggle="tooltip" class="favorite" data-bs-placement="top"
                                                            title="" data-bs-original-title="Favorit">
                                                            <a href="" class="delete-favorite"
                                                                data-id="{{ $product->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" style="color: red" fill="currentColor"
                                                                    class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1" />
                                                                </svg>
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                            data-bs-original-title="Favorit">
                                                            <a href="" class="add-favorite"
                                                                data-id="{{ $product->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-suit-heart" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z" />
                                                                </svg>

                                                            </a>
                                                        </li>
                                                    @endif
                                                @endauth
                                                @guest
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Favorit">
                                                        <a href="/login" class="add-favorite"
                                                            data-id="{{ $product->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-suit-heart"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z" />
                                                            </svg>

                                                        </a>
                                                    </li>
                                                @endguest
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <h4><a
                                                    href="{{ route('home.category', $product->category->id) }}">{{ $product->category->name }}</a>
                                            </h4>
                                            <a href="{{ route('home.products.show', $product->slug) }}">
                                                <h3 class="name mb-1">{{ $product->name }}</h3>
                                            </a>
                                            @auth
                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                    <h4 class="badge bg-warning">Discount:
                                                        {{ $product->reseller_discount }}%</h4>
                                                @else
                                                    <h4><span class="badge bg-warning">Discount:
                                                            {{ $product->discount }}%</span></h4>
                                                @endif
                                            @else
                                                <h4><span class="badge bg-warning">Discount: {{ $product->discount }}%</span>
                                                </h4>
                                            @endauth


                                            <h5 class="price">
                                                @if ($product->varianProducts->isEmpty())
                                                    @auth
                                                        @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                            @if ($product->reseller_discount)
                                                                <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                            @endif
                                                            <h4 class="theme-color fw-bold">
                                                                {{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->reseller_discount, true) }}
                                                            </h4>
                                                        @else
                                                            @if ($product->discount)
                                                                <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                            @endif
                                                            <h4 class="theme-color fw-bold">
                                                                {{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}
                                                            </h4>
                                                        @endif
                                                    @else
                                                        @if ($product->discount)
                                                            <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                        @endif
                                                        <h4 class="theme-color fw-bold">
                                                            {{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}
                                                        </h4>
                                                    @endauth
                                                @else
                                                    @auth
                                                        @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                            @if ($product->reseller_discount != 0)
                                                                <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($product->varianProducts)) }}</del>
                                                                -
                                                                <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($product->varianProducts)) }}</del>
                                                            @endif
                                                            <h4 class="theme-color fw-bold">
                                                                {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($product->varianProducts), $product->reseller_discount)) }}
                                                                -
                                                                {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($product->varianProducts), $product->reseller_discount)) }}
                                                            </h4>
                                                        @else
                                                            @if ($product->discount != 0)
                                                                <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($product->varianProducts)) }}
                                                                    -
                                                                    {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($product->varianProducts)) }}</del>
                                                            @endif
                                                            <h4 class="theme-color fw-bold">
                                                                {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($product->varianProducts), $product->discount, true) }}
                                                                -
                                                                {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($product->varianProducts), $product->discount, true) }}
                                                            </h4>
                                                        @endif
                                                    @else
                                                        @if ($product->discount != 0)
                                                            <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($product->varianProducts)) }}
                                                                -
                                                                {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($product->varianProducts)) }}</del>
                                                        @endif
                                                        <h4 class="theme-color fw-bold">
                                                            {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($product->varianProducts), $product->discount)) }}
                                                            -
                                                            {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($product->varianProducts), $product->discount, true) }}
                                                        </h4>
                                                    @endauth
                                                @endif

                                            </h5>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <li>
                                                            @if ($i <= RatingHelper::sumProductRatings($product->id)['stars'])
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-star fill">
                                                                    <polygon
                                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                                    </polygon>
                                                                </svg>
                                                            @else
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-star">
                                                                    <polygon
                                                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                                    </polygon>
                                                                </svg>
                                                            @endif
                                                        </li>
                                                    @endfor

                                                </ul>
                                                @if (RatingHelper::sumProductRatings($product->id)['sumRating'] == 0)
                                                    <span>(Belum ada ulasan)</span>
                                                @else
                                                    <span>{{ RatingHelper::sumProductRatings($product->id)['sumRating'] }}
                                                        ({{ $product->product_ratings_count }} ulasan)
                                                    </span>
                                                @endif

                                            </div>
                                            <h6 class="unit">
                                                @if ($product->status === ProductStatusEnum::AVAILABLE->value)
                                                    @if ($product->licenses_count > 0)
                                                        <h4>
                                                            <span class="badge rounded-pill text-bg-success"> Tersedia:
                                                                {{ $product->licenses_count }} Stok</span>
                                                        </h4>
                                                    @else
                                                        <h4>
                                                            <span class="badge rounded-pill text-bg-danger">Produk telah
                                                                habis</span>
                                                        </h4>
                                                    @endif
                                                @else
                                                    <h4>
                                                        <span
                                                            class="badge rounded-pill text-bg-info text-white">Preorder</span>
                                                    </h4>
                                                @endif
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if (count($highestRatingProducts) <= 8)
                            @if (count($latestProductNotRatings) >= 8 - count($highestRatingProducts))
                                @for ($i = 0; $i < 8 - count($highestRatingProducts); $i++)
                                    <div class="loopProducts" id="latestProduct">
                                        <div class="product-box-3 h-100 wow fadeInUp"
                                            style="visibility: visible; animation-name: fadeInUp;">
                                            <div class="product-header">
                                                <div class="product-image">
                                                    <a
                                                        href="{{ route('home.products.show', $latestProductNotRatings[$i]->slug) }}">
                                                        <img src="{{ asset('storage/' . $latestProductNotRatings[$i]->photo) }}"
                                                            class="img-fluid blur-up lazyloaded" alt="">
                                                    </a>
                                                    <ul class="product-option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="" data-bs-original-title="Lihat Produk">
                                                            <a
                                                                href="{{ route('home.products.show', $latestProductNotRatings[$i]->slug) }}">
                                                                <i data-feather="eye"></i>
                                                            </a>
                                                        </li>

                                                        <li data-bs-toggle="tooltip"
                                                            data-bs-original-title="Bagikan Produk">
                                                            @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                                <a href="#" onclick="return false;">
                                                                    <i data-feather="share-2" data-bs-toggle="modal"
                                                                        data-bs-target="#shareProductModal"
                                                                        data-slug="{{ $latestProductNotRatings[$i]->slug }}"
                                                                        id="shareButtonsTrigger"
                                                                        data-code="{{ auth()->user()->code_affiliate }}"></i>
                                                                </a>
                                                            @else
                                                                <a href="#" onclick="return false;">
                                                                    <i data-feather="share-2" data-bs-toggle="modal"
                                                                        data-bs-target="#shareProductModal"
                                                                        data-slug="{{ $latestProductNotRatings[$i]->slug }}"
                                                                        id="shareButtonsTrigger"></i>
                                                                </a>
                                                            @endif
                                                        </li>
                                                        @auth
                                                            @if ($latestProductNotRatings[$i]->product_favorites->where('user_id', auth()->user()->id)->first())
                                                                <li data-bs-toggle="tooltip" class="favorite"
                                                                    data-bs-placement="top" title=""
                                                                    data-bs-original-title="Favorit">
                                                                    <a href="" class="delete-favorite"
                                                                        data-id="{{ $latestProductNotRatings[$i]->id }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                            height="16" style="color: red"
                                                                            fill="currentColor" class="bi bi-suit-heart-fill"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1" />
                                                                        </svg>
                                                                    </a>
                                                                </li>
                                                            @else
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="" data-bs-original-title="Favorit">
                                                                    <a href="" class="add-favorite"
                                                                        data-id="{{ $latestProductNotRatings[$i]->id }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                            height="16" fill="currentColor"
                                                                            class="bi bi-suit-heart" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z" />
                                                                        </svg>

                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endauth
                                                        @guest
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="" data-bs-original-title="Favorit">
                                                                <a href="/login" class="add-favorite"
                                                                    data-id="{{ $latestProductNotRatings[$i]->id }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-suit-heart" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z" />
                                                                    </svg>

                                                                </a>
                                                            </li>
                                                        @endguest
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-footer">
                                                <div class="product-detail">
                                                    <h4><a
                                                            href="{{ route('home.category', $latestProductNotRatings[$i]->category->id) }}">{{ $latestProductNotRatings[$i]->category->name }}</a>
                                                    </h4>

                                                    <a
                                                        href="{{ route('home.products.show', $latestProductNotRatings[$i]->slug) }}">
                                                        <h3 class="name mb-1">{{ $latestProductNotRatings[$i]->name }}
                                                        </h3>
                                                    </a>
                                                    @auth
                                                        @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                            <h4 class="badge bg-warning">Discount:
                                                                {{ $latestProductNotRatings[$i]->reseller_discount }}%</h4>
                                                        @else
                                                            <h4><span class="badge bg-warning">Discount:
                                                                    {{ $latestProductNotRatings[$i]->discount }}%</span></h4>
                                                        @endif
                                                    @else
                                                        <h4><span class="badge bg-warning">Discount:
                                                                {{ $latestProductNotRatings[$i]->discount }}%</span>
                                                        </h4>
                                                    @endauth

                                                    <h5 class="price">
                                                        @if ($latestProductNotRatings[$i]->varianProducts->isEmpty())
                                                            @auth
                                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                                    @if ($latestProductNotRatings[$i]->reseller_discount)
                                                                        <del>{{ CurrencyHelper::rupiahCurrency($latestProductNotRatings[$i]->sell_price) }}</del>
                                                                    @endif
                                                                    <h4 class="theme-color fw-bold">
                                                                        {{ CurrencyHelper::countPriceAfterDiscount($latestProductNotRatings[$i]->sell_price, $latestProductNotRatings[$i]->reseller_discount, true) }}
                                                                    </h4>
                                                                @else
                                                                    @if ($latestProductNotRatings[$i]->discount)
                                                                        <del>{{ CurrencyHelper::rupiahCurrency($latestProductNotRatings[$i]->sell_price) }}</del>
                                                                    @endif
                                                                    <h4 class="theme-color fw-bold">
                                                                        {{ CurrencyHelper::countPriceAfterDiscount($latestProductNotRatings[$i]->sell_price, $latestProductNotRatings[$i]->discount, true) }}
                                                                    </h4>
                                                                @endif
                                                            @else
                                                                @if ($latestProductNotRatings[$i]->discount)
                                                                    <del>{{ CurrencyHelper::rupiahCurrency($latestProductNotRatings[$i]->sell_price) }}</del>
                                                                @endif
                                                                <h4 class="theme-color fw-bold">
                                                                    {{ CurrencyHelper::countPriceAfterDiscount($latestProductNotRatings[$i]->sell_price, $latestProductNotRatings[$i]->discount, true) }}
                                                                </h4>
                                                            @endauth
                                                        @else
                                                            @auth
                                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                                    @if ($latestProductNotRatings[$i]->reseller_discount != 0)
                                                                        <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($latestProductNotRatings[$i]->varianProducts)) }}</del>
                                                                        -
                                                                        <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($latestProductNotRatings[$i]->varianProducts)) }}</del>
                                                                    @endif
                                                                    <h4 class="theme-color fw-bold">
                                                                        {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($latestProductNotRatings[$i]->varianProducts), $latestProductNotRatings[$i]->reseller_discount)) }}
                                                                        -
                                                                        {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($latestProductNotRatings[$i]->varianProducts), $latestProductNotRatings[$i]->reseller_discount)) }}
                                                                    </h4>
                                                                @else
                                                                    @if ($latestProductNotRatings[$i]->discount != 0)
                                                                        <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($latestProductNotRatings[$i]->varianProducts)) }}
                                                                            -
                                                                            {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($latestProductNotRatings[$i]->varianProducts)) }}</del>
                                                                    @endif
                                                                    <h4 class="theme-color fw-bold">
                                                                        {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($latestProductNotRatings[$i]->varianProducts), $latestProductNotRatings[$i]->discount, true) }}
                                                                        -
                                                                        {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($latestProductNotRatings[$i]->varianProducts), $latestProductNotRatings[$i]->discount, true) }}
                                                                    </h4>
                                                                @endif
                                                            @else
                                                                @if ($latestProductNotRatings[$i]->discount != 0)
                                                                    <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($latestProductNotRatings[$i]->varianProducts)) }}
                                                                        -
                                                                        {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($latestProductNotRatings[$i]->varianProducts)) }}</del>
                                                                @endif
                                                                <h4 class="theme-color fw-bold">
                                                                    {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($latestProductNotRatings[$i]->varianProducts), $latestProductNotRatings[$i]->discount)) }}
                                                                    -
                                                                    {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($latestProductNotRatings[$i]->varianProducts), $latestProductNotRatings[$i]->discount, true) }}
                                                                </h4>
                                                            @endauth
                                                        @endif

                                                    </h5>
                                                    <div class="product-rating mt-2">
                                                        <ul class="rating">
                                                            @for ($j = 1; $j <= 5; $j++)
                                                                <li>
                                                                    @if ($j <= RatingHelper::sumProductRatings($latestProductNotRatings[$i]->id)['stars'])
                                                                        <i data-feather="star" class="fill"></i>
                                                                    @else
                                                                        <i data-feather="star"></i>
                                                                    @endif
                                                                </li>
                                                            @endfor

                                                        </ul>
                                                        @if (RatingHelper::sumProductRatings($latestProductNotRatings[$i]->id)['sumRating'] == 0)
                                                            <span>(Belum ada ulasan)</span>
                                                        @else
                                                            <span>{{ RatingHelper::sumProductRatings($latestProductNotRatings[$i]->id)['sumRating'] }}
                                                                ({{ $latestProductNotRatings[$i]->product_ratings_count }}
                                                                ulasan)
                                                            </span>
                                                        @endif

                                                    </div>
                                                    <h6 class="unit">
                                                        @if ($latestProductNotRatings[$i]->status === ProductStatusEnum::AVAILABLE->value)
                                                            @if ($latestProductNotRatings[$i]->licenses_count > 0)
                                                                <h4>
                                                                    <span class="badge rounded-pill text-bg-success">
                                                                        Tersedia:
                                                                        {{ $latestProductNotRatings[$i]->licenses_count }}
                                                                        Stok</span>
                                                                </h4>
                                                            @else
                                                                <h4>
                                                                    <span class="badge rounded-pill text-bg-danger">Produk
                                                                        telah
                                                                        habis</span>
                                                                </h4>
                                                            @endif
                                                        @else
                                                            <h4>
                                                                <span
                                                                    class="badge rounded-pill text-bg-info text-white">Preorder</span>
                                                            </h4>
                                                        @endif
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @else
                                @for ($i = 0; $i < count($latestProductNotRatings); $i++)
                                    <div class="loopProducts" id="latestProduct">
                                        <div class="product-box-3 h-100 wow fadeInUp"
                                            style="visibility: visible; animation-name: fadeInUp;">
                                            <div class="product-header">
                                                <div class="product-image">
                                                    <a
                                                        href="{{ route('home.products.show', $latestProductNotRatings[$i]->slug) }}">
                                                        <img src="{{ asset('storage/' . $latestProductNotRatings[$i]->photo) }}"
                                                            class="img-fluid blur-up lazyloaded" alt="">
                                                    </a>
                                                    <ul class="product-option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="" data-bs-original-title="Lihat Produk">
                                                            <a
                                                                href="{{ route('home.products.show', $latestProductNotRatings[$i]->slug) }}">
                                                                <i data-feather="eye"></i>
                                                            </a>
                                                        </li>

                                                        <li data-bs-toggle="tooltip"
                                                            data-bs-original-title="Bagikan Produk">
                                                            @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                                <a href="#" onclick="return false;">
                                                                    <i data-feather="share-2" data-bs-toggle="modal"
                                                                        data-bs-target="#shareProductModal"
                                                                        data-slug="{{ $latestProductNotRatings[$i]->slug }}"
                                                                        id="shareButtonsTrigger"
                                                                        data-code="{{ auth()->user()->code_affiliate }}"></i>
                                                                </a>
                                                            @else
                                                                <a href="#" onclick="return false;">
                                                                    <i data-feather="share-2" data-bs-toggle="modal"
                                                                        data-bs-target="#shareProductModal"
                                                                        data-slug="{{ $latestProductNotRatings[$i]->slug }}"
                                                                        id="shareButtonsTrigger"></i>
                                                                </a>
                                                            @endif
                                                        </li>
                                                        @auth
                                                            @if ($latestProductNotRatings[$i]->product_favorites->where('user_id', auth()->user()->id)->first())
                                                                <li data-bs-toggle="tooltip" class="favorite"
                                                                    data-bs-placement="top" title=""
                                                                    data-bs-original-title="Favorit">
                                                                    <a href="" class="delete-favorite"
                                                                        data-id="{{ $latestProductNotRatings[$i]->id }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                            height="16" style="color: red"
                                                                            fill="currentColor" class="bi bi-suit-heart-fill"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1" />
                                                                        </svg>
                                                                    </a>
                                                                </li>
                                                            @else
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="" data-bs-original-title="Favorit">
                                                                    <a href="" class="add-favorite"
                                                                        data-id="{{ $latestProductNotRatings[$i]->id }}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                            height="16" fill="currentColor"
                                                                            class="bi bi-suit-heart" viewBox="0 0 16 16">
                                                                            <path
                                                                                d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z" />
                                                                        </svg>

                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endauth
                                                        @guest
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="" data-bs-original-title="Favorit">
                                                                <a href="/login" class="add-favorite"
                                                                    data-id="{{ $latestProductNotRatings[$i]->id }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-suit-heart" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z" />
                                                                    </svg>

                                                                </a>
                                                            </li>
                                                        @endguest
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-footer">
                                                <div class="product-detail">
                                                    <h4><a
                                                            href="{{ route('home.category', $latestProductNotRatings[$i]->category->id) }}">{{ $latestProductNotRatings[$i]->category->name }}</a>
                                                    </h4>

                                                    <a
                                                        href="{{ route('home.products.show', $latestProductNotRatings[$i]->slug) }}">
                                                        <h3 class="name mb-1">{{ $latestProductNotRatings[$i]->name }}
                                                        </h3>
                                                    </a>
                                                    @auth
                                                        @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                            <h4 class="badge bg-warning">Discount:
                                                                {{ $latestProductNotRatings[$i]->reseller_discount }}%</h4>
                                                        @else
                                                            <h4><span class="badge bg-warning">Discount:
                                                                    {{ $latestProductNotRatings[$i]->discount }}%</span></h4>
                                                        @endif
                                                    @else
                                                        <h4><span class="badge bg-warning">Discount:
                                                                {{ $latestProductNotRatings[$i]->discount }}%</span>
                                                        </h4>
                                                    @endauth

                                                    <h5 class="price">
                                                        @if ($latestProductNotRatings[$i]->varianProducts->isEmpty())
                                                            @auth
                                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                                    @if ($latestProductNotRatings[$i]->reseller_discount)
                                                                        <del>{{ CurrencyHelper::rupiahCurrency($latestProductNotRatings[$i]->sell_price) }}</del>
                                                                    @endif
                                                                    <h4 class="theme-color fw-bold">
                                                                        {{ CurrencyHelper::countPriceAfterDiscount($latestProductNotRatings[$i]->sell_price, $latestProductNotRatings[$i]->reseller_discount, true) }}
                                                                    </h4>
                                                                @else
                                                                    @if ($latestProductNotRatings[$i]->discount)
                                                                        <del>{{ CurrencyHelper::rupiahCurrency($latestProductNotRatings[$i]->sell_price) }}</del>
                                                                    @endif
                                                                    <h4 class="theme-color fw-bold">
                                                                        {{ CurrencyHelper::countPriceAfterDiscount($latestProductNotRatings[$i]->sell_price, $latestProductNotRatings[$i]->discount, true) }}
                                                                    </h4>
                                                                @endif
                                                            @else
                                                                @if ($latestProductNotRatings[$i]->discount)
                                                                    <del>{{ CurrencyHelper::rupiahCurrency($latestProductNotRatings[$i]->sell_price) }}</del>
                                                                @endif
                                                                <h4 class="theme-color fw-bold">
                                                                    {{ CurrencyHelper::countPriceAfterDiscount($latestProductNotRatings[$i]->sell_price, $latestProductNotRatings[$i]->discount, true) }}
                                                                </h4>
                                                            @endauth
                                                        @else
                                                            @auth
                                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                                    @if ($latestProductNotRatings[$i]->reseller_discount != 0)
                                                                        <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($latestProductNotRatings[$i]->varianProducts)) }}</del>
                                                                        -
                                                                        <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($latestProductNotRatings[$i]->varianProducts)) }}</del>
                                                                    @endif
                                                                    <h4 class="theme-color fw-bold">
                                                                        {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($latestProductNotRatings[$i]->varianProducts), $latestProductNotRatings[$i]->reseller_discount)) }}
                                                                        -
                                                                        {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($latestProductNotRatings[$i]->varianProducts), $latestProductNotRatings[$i]->reseller_discount)) }}
                                                                    </h4>
                                                                @else
                                                                    @if ($latestProductNotRatings[$i]->discount != 0)
                                                                        <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($latestProductNotRatings[$i]->varianProducts)) }}
                                                                            -
                                                                            {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($latestProductNotRatings[$i]->varianProducts)) }}</del>
                                                                    @endif
                                                                    <h4 class="theme-color fw-bold">
                                                                        {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($latestProductNotRatings[$i]->varianProducts), $latestProductNotRatings[$i]->discount, true) }}
                                                                        -
                                                                        {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($latestProductNotRatings[$i]->varianProducts), $latestProductNotRatings[$i]->discount, true) }}
                                                                    </h4>
                                                                @endif
                                                            @else
                                                                @if ($latestProductNotRatings[$i]->discount != 0)
                                                                    <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($latestProductNotRatings[$i]->varianProducts)) }}
                                                                        -
                                                                        {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($latestProductNotRatings[$i]->varianProducts)) }}</del>
                                                                @endif
                                                                <h4 class="theme-color fw-bold">
                                                                    {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($latestProductNotRatings[$i]->varianProducts), $latestProductNotRatings[$i]->discount)) }}
                                                                    -
                                                                    {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($latestProductNotRatings[$i]->varianProducts), $latestProductNotRatings[$i]->discount, true) }}
                                                                </h4>
                                                            @endauth
                                                        @endif

                                                    </h5>
                                                    <div class="product-rating mt-2">
                                                        <ul class="rating">
                                                            @for ($j = 1; $j <= 5; $j++)
                                                                <li>
                                                                    @if ($j <= RatingHelper::sumProductRatings($latestProductNotRatings[$i]->id)['stars'])
                                                                        <i data-feather="star" class="fill"></i>
                                                                    @else
                                                                        <i data-feather="star"></i>
                                                                    @endif
                                                                </li>
                                                            @endfor

                                                        </ul>
                                                        @if (RatingHelper::sumProductRatings($latestProductNotRatings[$i]->id)['sumRating'] == 0)
                                                            <span>(Belum ada ulasan)</span>
                                                        @else
                                                            <span>{{ RatingHelper::sumProductRatings($latestProductNotRatings[$i]->id)['sumRating'] }}
                                                                ({{ $latestProductNotRatings[$i]->product_ratings_count }}
                                                                ulasan)
                                                            </span>
                                                        @endif

                                                    </div>
                                                    <h6 class="unit">
                                                        @if ($latestProductNotRatings[$i]->status === ProductStatusEnum::AVAILABLE->value)
                                                            @if ($latestProductNotRatings[$i]->licenses_count > 0)
                                                                <h4>
                                                                    <span class="badge rounded-pill text-bg-success">
                                                                        Tersedia:
                                                                        {{ $latestProductNotRatings[$i]->licenses_count }}
                                                                        Stok</span>
                                                                </h4>
                                                            @else
                                                                <h4>
                                                                    <span class="badge rounded-pill text-bg-danger">Produk
                                                                        telah
                                                                        habis</span>
                                                                </h4>
                                                            @endif
                                                        @else
                                                            <h4>
                                                                <span
                                                                    class="badge rounded-pill text-bg-info text-white">Preorder</span>
                                                            </h4>
                                                        @endif
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="service-section">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Mengapa {{ config('app.name') }} ?</h2>
                <span class="title-leaf">
                    <svg class="icon-width">
                        <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
                    </svg>
                </span>
                <p>Beberapa alasan mengapa anda harus memilih kami..</p>
            </div>
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
            <div class="title">
                <h2>Produk Terbaru</h2>
                <span class="title-leaf">
                    <svg class="icon-width">
                        <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
                    </svg>
                </span>
                <p>Belum menemukan produk yang anda cari? berikut adalah produk terbaru dari kami.</p>
            </div>
            <div id="productContainer"
                class="row g-sm-4 g-3 product-list-section row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 mt-3 mb-5">
                @forelse($latestProducts as $product)
                    <div class="loopProducts" id="latestProduct">
                        <div class="product-box-3 h-100 wow fadeInUp"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <div class="product-header">
                                <div class="product-image">
                                    <a href="{{ route('home.products.show', $product->slug) }}">
                                        <img src="{{ asset('storage/' . $product->photo) }}"
                                            class="img-fluid blur-up lazyloaded" alt="">
                                    </a>
                                    <ul class="product-option">
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                            data-bs-original-title="Lihat Produk">
                                            <a href="{{ route('home.products.show', $product->slug) }}">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>

                                        <li data-bs-toggle="tooltip" data-bs-original-title="Bagikan Produk">
                                            @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                <a href="#" onclick="return false;">
                                                    <i data-feather="share-2" data-bs-toggle="modal"
                                                        data-bs-target="#shareProductModal"
                                                        data-slug="{{ $product->slug }}" id="shareButtonsTrigger"
                                                        data-code="{{ auth()->user()->code_affiliate }}"></i>
                                                </a>
                                            @else
                                                <a href="#" onclick="return false;">
                                                    <i data-feather="share-2" data-bs-toggle="modal"
                                                        data-bs-target="#shareProductModal"
                                                        data-slug="{{ $product->slug }}" id="shareButtonsTrigger"></i>
                                                </a>
                                            @endif
                                        </li>
                                        @auth
                                            @if ($product->product_favorites->where('user_id', auth()->user()->id)->first())
                                                <li data-bs-toggle="tooltip" class="favorite" data-bs-placement="top"
                                                    title="" data-bs-original-title="Favorit">
                                                    <a href="" class="delete-favorite"
                                                        data-id="{{ $product->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            style="color: red" fill="currentColor"
                                                            class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                                            <path
                                                                d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1" />
                                                        </svg>
                                                    </a>
                                                </li>
                                            @else
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Favorit">
                                                    <a href="" class="add-favorite" data-id="{{ $product->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-suit-heart" viewBox="0 0 16 16">
                                                            <path
                                                                d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z" />
                                                        </svg>

                                                    </a>
                                                </li>
                                            @endif
                                        @endauth
                                        @guest
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Favorit">
                                                <a href="/login" class="add-favorite" data-id="{{ $product->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-suit-heart" viewBox="0 0 16 16">
                                                        <path
                                                            d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z" />
                                                    </svg>

                                                </a>
                                            </li>
                                        @endguest
                                    </ul>
                                </div>
                            </div>
                            <div class="product-footer">
                                <div class="product-detail">
                                    <h4><a
                                            href="{{ route('home.category', $product->category->id) }}">{{ $product->category->name }}</a>
                                    </h4>
                                    <a href="{{ route('home.products.show', $product->slug) }}">
                                        <h3 class="name mb-1">{{ $product->name }}</h3>
                                    </a>
                                    @auth
                                        @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                            <h4 class="badge bg-warning">Discount:
                                                {{ $product->reseller_discount }}%</h4>
                                        @else
                                            <h4><span class="badge bg-warning">Discount: {{ $product->discount }}%</span>
                                            </h4>
                                        @endif
                                    @else
                                        <h4><span class="badge bg-warning">Discount: {{ $product->discount }}%</span></h4>
                                    @endauth


                                    <h5 class="price">
                                        @if ($product->varianProducts->isEmpty())
                                            @auth
                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                    @if ($product->reseller_discount)
                                                        <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                    @endif
                                                    <h4 class="theme-color fw-bold">
                                                        {{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->reseller_discount, true) }}
                                                    </h4>
                                                @else
                                                    @if ($product->discount)
                                                        <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                    @endif
                                                    <h4 class="theme-color fw-bold">
                                                        {{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}
                                                    </h4>
                                                @endif
                                            @else
                                                @if ($product->discount)
                                                    <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                @endif
                                                <h4 class="theme-color fw-bold">
                                                    {{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}
                                                </h4>
                                            @endauth
                                        @else
                                            @auth
                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                    @if ($product->reseller_discount != 0)
                                                        <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($product->varianProducts)) }}</del>
                                                        -
                                                        <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($product->varianProducts)) }}</del>
                                                    @endif
                                                    <h4 class="theme-color fw-bold">
                                                        {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($product->varianProducts), $product->reseller_discount)) }}
                                                        -
                                                        {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($product->varianProducts), $product->reseller_discount)) }}
                                                    </h4>
                                                @else
                                                    @if ($product->discount != 0)
                                                        <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($product->varianProducts)) }}
                                                            -
                                                            {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($product->varianProducts)) }}</del>
                                                    @endif
                                                    <h4 class="theme-color fw-bold">
                                                        {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($product->varianProducts), $product->discount, true) }}
                                                        -
                                                        {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($product->varianProducts), $product->discount, true) }}
                                                    </h4>
                                                @endif
                                            @else
                                                @if ($product->discount != 0)
                                                    <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($product->varianProducts)) }}
                                                        -
                                                        {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPriceMax($product->varianProducts)) }}</del>
                                                @endif
                                                <h4 class="theme-color fw-bold">
                                                    {{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($product->varianProducts), $product->discount)) }}
                                                    -
                                                    {{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPriceMax($product->varianProducts), $product->discount, true) }}
                                                </h4>
                                            @endauth
                                        @endif

                                    </h5>
                                    <div class="product-rating mt-2">
                                        <ul class="rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <li>
                                                    @if ($i <= RatingHelper::sumProductRatings($product->id)['stars'])
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-star fill">
                                                            <polygon
                                                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                            </polygon>
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-star">
                                                            <polygon
                                                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                            </polygon>
                                                        </svg>
                                                    @endif
                                                </li>
                                            @endfor

                                        </ul>
                                        @if (RatingHelper::sumProductRatings($product->id)['sumRating'] == 0)
                                            <span>(Belum ada ulasan)</span>
                                        @else
                                            <span>{{ RatingHelper::sumProductRatings($product->id)['sumRating'] }}
                                                ({{ $product->product_ratings_count }} ulasan)
                                            </span>
                                        @endif

                                    </div>
                                    <h6 class="unit">
                                        @if ($product->status === ProductStatusEnum::AVAILABLE->value)
                                            @if ($product->licenses_count > 0)
                                                <h4>
                                                    <span class="badge rounded-pill text-bg-success"> Tersedia:
                                                        {{ $product->licenses_count }} Stok</span>
                                                </h4>
                                            @else
                                                <h4>
                                                    <span class="badge rounded-pill text-bg-danger">Produk telah
                                                        habis</span>
                                                </h4>
                                            @endif
                                        @else
                                            <h4>
                                                <span class="badge rounded-pill text-bg-info text-white">Preorder</span>
                                            </h4>
                                        @endif
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="loopProducts">Belum ada transaksi.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="blog-section">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Artikel Terbaru</h2>
            </div>

            <div class="row">
                @forelse (ArticleHelper::topArticles(10) as $article)
                    <div class="col-12 col-md-4">
                        <div class="blog-box ratio_50">
                            <div class="blog-box-image">
                                <a href="{{ route('home.articles.show', $article->slug) }}" tabindex="-1"
                                    class="bg-size"
                                    style="background-image: url(&quot;../assets/images/veg-3/blog/2.jpg&quot;); background-size: cover; background-position: center center; background-repeat: no-repeat; display: block;">
                                    <img src="{{ asset('storage/' . $article->photo) }}" class="img-fluid bg-img"
                                        alt="{{ $article->title }}" style="display: none;">
                                </a>
                            </div>

                            <div class="blog-detail">
                                <label>{{ $article->category->name }}</label>
                                <a href="{{ route('home.articles.show', $article->slug) }}" tabindex="-1">
                                    <h2>{{ strlen($article->title) > 25 ? substr($article->title, 0, 30) . '...' : $article->title }}
                                    </h2>
                                </a>
                                <div class="blog-list">
                                    <span>{{ Carbon::parse($article->created_at)->translatedFormat('d F Y') }}</span>
                                    <span>Oleh : {{ $article->user->name }}</span>
                                </div>
                                <div class="blog-description mt-2">
                                    <p>{!! $article->content !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Artikel masih kosong</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
@section('script')
    <x-share-modal></x-share-modal>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".delete-favorite").click(function() {
                var productId = $(this).data("id");
                $.ajax({
                    url: "/product-favorites/" + productId,
                    method: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    success: function(response) {
                        productFavorite(productId)
                    },
                    error: function(xhr, status, error) {
                        console.error("Terjadi kesalahan: " + error);
                    }
                });
            });
        });

        $(document).ready(function() {
            $(".add-favorite").click(function() {
                var productId = $(this).data("id");
                $.ajax({
                    url: "/product-favorites/" + productId,
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    success: function(response) {
                        productFavorite(productId)
                    },
                    error: function(xhr, status, error) {
                        console.error("Terjadi kesalahan: " + error);
                    }
                });
            });
        });


        // $(document).ready(function() {
        //     $.ajax({
        //         url: "latest-product",
        //         method: "GET",
        //         success: function(data) {
        //             console.log(data.data);
        //             $.each('#latestProduct')
        //         },
        //         error: function(xhr, status, error) {
        //             console.error("Terjadi kesalahan: " + error);
        //         }
        //     });
        // });

        // function latestProduct() {
        //     return
        // }
    </script>
    <script>
        $(document).on('click', '#shareButtonsTrigger', function() {
            var slug = $(this).data('slug');
            var code = $(this).data('code');
            $('#shareProductModal').modal('show');
            // berikan nilai slug pada value sharewhatsappbutton

            $.ajax({
                url: "{{ route('home.share.product') }}" + "/" + slug,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    // Gunakan data yang diterima dari server (misalnya, update href)
                    $('#shareWhatsappButton').attr('href', response.data.whatsapp);
                    $('#shareFacebookButton').attr('href', response.data.facebook);
                    $('#shareTelegramButton').attr('href', response.data.telegram);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });

            $('#shareLinkButton').click(function() {
                var currentURL = "{{ URL::to('/products') }}"
                if (code) {
                    var urlToCopy = currentURL + '/' + slug + '/' + code;
                } else {
                    var urlToCopy = currentURL;
                }
                navigator.clipboard.writeText(urlToCopy).then(function() {
                    alert('Tautan berhasil disalin!');
                }, function(err) {
                    console.error('Gagal menyalin tautan: ', err);
                    alert('Gagal menyalin tautan. Silakan coba lagi.');
                });
            });

        });
    </script>
@endsection
