@php
    use App\Enums\ProductStatusEnum;
    use App\Enums\RatingStatusEnum;use App\Enums\UserRoleEnum;
    use App\Helpers\CurrencyHelper;
    use App\Helpers\RatingHelper;use App\Helpers\UserHelper;use Carbon\Carbon;
@endphp
@extends('layouts.main')
@section('asset')
    <style>
        .customDivStyle li {
            display: list-item !important;
        }
    </style>
@endsection
@section('content')
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>{{ $product->name }}</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home.index') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>

                                <li class="breadcrumb-item active">{{ $product->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-9 col-xl-8 col-lg-7 wow fadeInUp"
                     style="visibility: visible; animation-name: fadeInUp;">
                    <div class="row g-4">
                        <div class="col-xl-3 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                            <div class="product-left-box">
                                <div class="row g-2">
                                    <div class="col-12">
                                        <div class="product-main-1 no-arrow">
                                            <img src="{{ asset('storage/' . $product->photo) }}" id="img-1"
                                                 data-zoom-image="../assets/images/product/category/1.jpg"
                                                 class="img-fluid image_zoom_cls-0 blur-up lazyloaded" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-9 wow fadeInUp" data-wow-delay="0.1s"
                             style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                            <div class="right-box-contain">
                                <h6 class="offer-top">{{ $product->category->name }}</h6>
                                @if ($product->discount > 0)
                                    <h6 class="offer-top">Diskon : {{ $product->discount . '%' }}</h6>
                                @endif


                                <h2 class="name">{{ $product->name }}</h2>

                                <div class="procuct-contain">
                                    <p>{{ $product->short_description }}</p>
                                </div>

                                <div class="col-12 mb-3">
                                    @if ($product->status === ProductStatusEnum::AVAILABLE->value)
                                        @if ($product->licenses_count > 0)
                                            <h4 class="mt-3">
                                                <span class="badge rounded-pill text-bg-success"> Tersedia:
                                                    {{ $product->licenses_count }} Stok</span>
                                            </h4>
                                        @else
                                            <h4 class="mt-3">
                                                <span
                                                    class="badge rounded-pill text-bg-danger">Produk telah habis</span>
                                            </h4>
                                        @endif
                                    @else
                                        <h4 class="mt-3">
                                            <span class="badge rounded-pill text-bg-danger">Preorder Produk</span>
                                        </h4>
                                    @endif

                                </div>

                                <div class="price-rating">

                                    @guest
                                        <h3 class="theme-color price">
                                            {{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}
                                            @if ($product->discount > 0)
                                                <del
                                                    class="text-content">{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                            @endif
                                        </h3>
                                    @else
                                        @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                            <h3 class="theme-color price">
                                                {{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->reseller_discount, true) }}
                                                @if ($product->reseller_discount > 0)
                                                    <del
                                                        class="text-content">{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                @endif
                                            </h3>
                                        @else
                                            <h3 class="theme-color price">
                                                {{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}
                                                @if ($product->discount > 0)
                                                    <del
                                                        class="text-content">{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                @endif
                                            </h3>
                                        @endif
                                    @endguest
                                    <div class="product-rating custom-rate">
                                        <ul class="rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <li>
                                                    @if($i <= RatingHelper::sumProductRatings($product->id)['stars'])
                                                        <i data-feather="star" class="fill"></i>
                                                    @else
                                                        <i data-feather="star"></i>
                                                    @endif
                                                </li>
                                            @endfor

                                        </ul>
                                        @if(RatingHelper::sumProductRatings($product->id)['sumRating'] == 0)
                                            <span class="review">Belum ada ulasan</span>

                                        @else
                                            <span class="review">{{ RatingHelper::sumProductRatings($product->id)['sumRating'] }} ({{ $product->product_ratings_count }} ulasan)</span>
                                        @endif

                                    </div>
                                </div>
                                <div class="buy-box">
                                    <a href="#">
                                        <i data-feather="heart"></i>
                                        <span>Tambah ke Favorit</span>
                                    </a>

                                    <a href="#">
                                        <i data-feather="refresh-cw"></i>
                                        <span>Bandingkan Produk</span>
                                    </a>
                                </div>

                            </div>

                            <div class="note-box product-packege mt-5 justify-content-center">
                                @if ($product->status === ProductStatusEnum::AVAILABLE->value)
                                    @if ($product->licenses_count > 0)
                                        <a href="{{ route('checkout', $product->slug) }}"
                                           class="btn btn-md bg-dark cart-button text-white w-50">Beli Produk
                                        </a>
                                    @else
                                        <button class="btn btn-md bg-danger cart-button text-white w-50">Stok produk
                                            telah habis
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ route('checkout', $product->slug) }}"
                                       class="btn btn-md bg-dark cart-button text-white w-50">Preorder Produk
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="product-section-box">
                            <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                            data-bs-target="#description" type="button" role="tab"
                                            aria-controls="description" aria-selected="true">Deskripsi
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info"
                                            type="button" role="tab" aria-controls="info" aria-selected="false">Fitur
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="question-tab" data-bs-toggle="tab"
                                            data-bs-target="#question"
                                            type="button" role="tab" aria-controls="question"
                                            aria-selected="false">Pertanyaan
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="care-tab" data-bs-toggle="tab" data-bs-target="#care"
                                            type="button" role="tab" aria-controls="care" aria-selected="false">Tata
                                        Cara Instalasi
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="review-tab" data-bs-toggle="tab"
                                            data-bs-target="#review" type="button" role="tab" aria-controls="review"
                                            aria-selected="false">Ulasan Pelanggan
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content custom-tab" id="myTabContent">
                                <div class="tab-pane fade show active customDivStyle" id="description" role="tabpanel"
                                     aria-labelledby="description-tab">
                                    <div class="product-description">
                                        <div class="nav-desh">
                                            @if($product->description)
                                                <p>{!! $product->description !!}</p>
                                            @else
                                                <p>Belum ada deskripsi.</p>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade customDivStyle" id="info" role="tabpanel"
                                     aria-labelledby="info-tab">
                                    <div class="product-description">
                                        <div class="nav-desh">
                                            @if($product->features)
                                                <p>{!! $product->features !!}</p>
                                            @else
                                                <p>Belum ada fitur.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="question" role="tabpanel" aria-labelledby="question-tab">
                                    <div class="table-responsive">
                                        <table class="table info-table">
                                            @if(count($product->product_questions) > 0)
                                                <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Pertanyaan</th>
                                                    <th>Penjelasan</th>
                                                </tr>
                                                </thead>
                                            @endif

                                            <tbody>
                                            @forelse ($product->product_questions as $question)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $question->question }}</td>
                                                    <td>{{ $question->answer }}</td>
                                                </tr>
                                            @empty
                                                <p>Belum ada pertanyaan.</p>
                                            @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade customDivStyle" id="care" role="tabpanel"
                                     aria-labelledby="care-tab">
                                    <div class="product-description">
                                        <div class="nav-desh">
                                            {!! $product->installation !!}
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                    <div class="review-box">
                                        <div class="row g-4">
                                            <div class="col-12">
                                                <div class="review-title">
                                                    <h4 class="fw-500">Rating & Ulasan Pelanggan terbaru terkait
                                                        produk: {{ $product->name }}</h4>
                                                </div>

                                                <div class="review-people mt-5">
                                                    <ul class="review-list">
                                                        @forelse(RatingHelper::getProductRatings($product->id, RatingStatusEnum::APPROVED->value, 10) as $rating)
                                                            <li>
                                                                <div class="people-box">
                                                                    <div>
                                                                        <div class="people-image">
                                                                            @if($rating->user->photo)
                                                                                <img
                                                                                    src="{{ asset('storage/' . $rating->user->photo) }}"
                                                                                    class="img-fluid blur-up lazyload"
                                                                                    alt="{{ $rating->user->name }}">
                                                                            @else
                                                                                <img
                                                                                    src="{{ asset('avatar.png') }}"
                                                                                    class="img-fluid blur-up lazyload"
                                                                                    alt="{{ $rating->user->name }}">
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="people-comment">
                                                                        <a class="name"
                                                                           href="#">{{  $rating->user->name }}</a>
                                                                        <div class="date-time">
                                                                            <h6 class="text-content">{{ Carbon::parse($rating->created_at)->translatedFormat('d F Y H:i') }}</h6>

                                                                            <div class="product-rating">
                                                                                <ul class="rating">
                                                                                    @for($i = 1; $i <= 5; $i++)
                                                                                        <li>
                                                                                            @if($i <= RatingHelper::sumProductRatings($product->id)['stars'])
                                                                                                <i data-feather="star"
                                                                                                   class="fill"></i>
                                                                                            @else
                                                                                                <i data-feather="star"></i>
                                                                                            @endif
                                                                                        </li>
                                                                                    @endfor

                                                                                </ul>
                                                                            </div>
                                                                        </div>

                                                                        <div class="reply">
                                                                            <p>{{ $rating->review }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @empty
                                                            <p>Belum ada Ulasan & Rating.</p>
                                                        @endforelse

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp"
                     style="visibility: visible; animation-name: fadeInUp;">
                    <div class="right-sidebar-box">
                        <!-- Trending Product -->
                        <div class="pt-25">
                            <div class="category-menu">
                                <h3>Rekomendasi Lainnya</h3>

                                <ul class="product-list product-right-sidebar border-0 p-0">
                                    @foreach($recommendProducts as $product)
                                        <li>
                                            <div class="offer-product">
                                                <a href="{{ route('home.products.show', $product->slug) }}"
                                                   class="offer-image">
                                                    <img src="{{ asset('storage/' . $product->photo) }}"
                                                         class="img-fluid blur-up lazyloaded"
                                                         alt="{{ $product->name }}">
                                                </a>

                                                <div class="offer-detail">
                                                    <div>
                                                        <a href="{{ route('home.products.show', $product->slug) }}">
                                                            <h6 class="name">{{ $product->name }}</h6>
                                                        </a>
                                                        <span>{{ $product->category->name }}</span>
                                                        <h6 class="price theme-color">
                                                            @guest
                                                                <span
                                                                    class="theme-color">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount,true) }}</span>

                                                            @else
                                                                @if(UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                                    <span
                                                                        class="theme-color">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->reseller_discount,true) }}</span>
                                                                @else
                                                                    <span
                                                                        class="theme-color">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount,true) }}</span>
                                                                @endif
                                                            @endguest
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product-list-section section-b-space mt-3">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Produk Serupa Lainnya</h2>
                <span class="title-leaf">
                    <svg class="icon-width">
                        <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
                    </svg>
                </span>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="slider-5_1 product-wrapper slick-slider slick-dotted">
                        @forelse($sameCategoryProducts as $product)
                            <div class="product-box-3 wow fadeInUp m-2" data-wow-delay="0.25s"
                                 style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                                <div class="product-header">
                                    <div class="product-image">
                                        <a href="{{ route('home.products.show', $product->slug) }}"
                                           tabindex="-1">
                                            <img src="{{ asset('storage/' . $product->photo) }}"
                                                 class="img-fluid blur-up lazyloaded"
                                                 alt="{{ $product->name }}">
                                        </a>

                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Lihat Produk">
                                                <a href="{{ route('home.products.show', $product->slug) }}">
                                                    <i data-feather="eye"></i>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Bandingkan Produk">
                                                <a href="#">
                                                    <i data-feather="refresh-cw"></i>

                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Favorit">
                                                <a href="#" class="notifi-wishlist">
                                                    <i data-feather="heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="product-footer">
                                    <div class="product-detail">
                                        <span class="span-name">{{ $product->category->name }}</span>
                                        <h5 class="name">
                                            {{ (strlen($product->name) > 15) ? substr($product->name, 0, 18) . "..." : $product->name }}</h5>
                                        <div class="product-rating mt-2">
                                            <ul class="rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <li>
                                                        @if($i <= RatingHelper::sumProductRatings($product->id)['stars'])
                                                            <i data-feather="star" class="fill"></i>
                                                        @else
                                                            <i data-feather="star"></i>
                                                        @endif
                                                    </li>
                                                @endfor

                                            </ul>
                                            @if(RatingHelper::sumProductRatings($product->id)['sumRating'] == 0)
                                                <span>(0 ulasan)</span>

                                            @else
                                                <span>{{ RatingHelper::sumProductRatings($product->id)['sumRating'] }} ({{ $product->product_ratings_count }} ulasan)</span>
                                            @endif

                                        </div>
                                        <h6 class="unit">
                                            @if($product->status === ProductStatusEnum::AVAILABLE->value)
                                                @if($product->licenses_count > 0)
                                                    <h4>
                                                        <span class="badge rounded-pill text-bg-success"> Tersedia: {{ $product->licenses_count }} Stok</span>
                                                    </h4>
                                                @else
                                                    <h4>
                                                    <span
                                                        class="badge rounded-pill text-bg-danger">Produk telah habis</span>
                                                    </h4>
                                                @endif
                                            @else
                                                <h4>
                                                                <span
                                                                    class="badge rounded-pill text-bg-danger">Preorder</span>
                                                </h4>
                                            @endif
                                        </h6>
                                        <h5 class="price mt-3">
                                            @guest
                                                <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                <br>
                                                <span
                                                    class="theme-color">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount,true) }}</span>

                                            @else
                                                @if(UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                    <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                    <br>
                                                    <span
                                                        class="theme-color">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->reseller_discount,true) }}</span>

                                                @else
                                                    <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                    <br>
                                                    <span
                                                        class="theme-color">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount,true) }}</span>
                                                @endif
                                            @endguest

                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Belum ada produk.</p>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
