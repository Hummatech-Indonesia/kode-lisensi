@php
    use App\Enums\ProductStatusEnum;
    use App\Enums\RatingStatusEnum;
    use App\Enums\UserRoleEnum;
    use App\Helpers\CurrencyHelper;
    use App\Helpers\RatingHelper;
    use App\Helpers\UserHelper;
    use Carbon\Carbon;
@endphp
@extends('layouts.main')
@section('asset')
    <link rel="stylesheet" href="{{ asset('assets/css/style-select-package.css') }}">
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
                <div class="col-xxl-12">
                    @if (session('success'))
                        <x-alert-success></x-alert-success>
                    @elseif($errors->any())
                        <x-validation-errors :errors="$errors"></x-validation-errors>
                    @endif
                </div>
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
                                                <span class="badge rounded-pill text-bg-danger">Produk telah habis</span>
                                            </h4>
                                        @endif
                                    @else
                                        <h4 class="mt-3">
                                            <span class="badge rounded-pill text-bg-danger">Preorder Produk</span>
                                        </h4>
                                    @endif

                                </div>

                                <div class="price-rating">
                                    @if ($product->varianProducts->first() == null)
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
                                    @else
                                        @guest
                                            <div class="d-flex">
                                                <h3 class="theme-color price" id="discount-price">
                                                    {{ CurrencyHelper::countPriceAfterDiscount($product->varianProducts[0]->sell_price, $product->discount, true) }}
                                                </h3>
                                                @if ($product->discount != 0)
                                                    <del class="text-discount mx-2"
                                                        id="price-product">{{ CurrencyHelper::rupiahCurrency($product->varianProducts[0]->sell_price) }}</del>
                                                @endif
                                                <span class="hidden-product review mx-2">||</span>
                                                <span
                                                    class="hidden-product review">{{ $product->varianProducts[0]->name }}</span>
                                            </div>
                                        @else
                                            @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                <div class="d-flex">
                                                    <h3 class="theme-color price" id="discount-price">
                                                        {{ CurrencyHelper::countPriceAfterDiscount($product->varianProducts[0]->sell_price, $product->reseller_discount, true) }}
                                                    </h3>
                                                    @if ($product->reseller_discount != 0)
                                                        <del class="text-discount mx-2"
                                                            id="price-product">{{ CurrencyHelper::rupiahCurrency($product->varianProducts[0]->sell_price) }}</del>
                                                    @endif
                                                    <span class="hidden-product review mx-2">||</span>
                                                    <span
                                                        class="hidden-product review">{{ $product->varianProducts[0]->name }}</span>
                                                </div>
                                            @else
                                                <div class="d-flex">
                                                    <h3 class="theme-color price" id="discount-price">
                                                        {{ CurrencyHelper::countPriceAfterDiscount($product->varianProducts[0]->sell_price, $product->discount, true) }}
                                                    </h3>
                                                    @if ($product->discount != 0)
                                                        <del class="text-discount mx-2"
                                                            id="price-product">{{ CurrencyHelper::rupiahCurrency($product->varianProducts[0]->sell_price) }}</del>
                                                    @endif
                                                    <span class="hidden-product review mx-2">||</span>
                                                    <span
                                                        class="hidden-product review">{{ $product->varianProducts[0]->name }}</span>
                                                </div>
                                            @endif
                                        @endguest
                                    @endif
                                    <div class="product-rating custom-rate">
                                        <ul class="rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <li>
                                                    @if ($i <= RatingHelper::sumProductRatings($product->id)['stars'])
                                                        <i data-feather="star" class="fill"></i>
                                                    @else
                                                        <i data-feather="star"></i>
                                                    @endif
                                                </li>
                                            @endfor

                                        </ul>
                                        @if (RatingHelper::sumProductRatings($product->id)['sumRating'] == 0)
                                            <span class="review">Belum ada ulasan</span>
                                        @else
                                            <span
                                                class="review">{{ RatingHelper::sumProductRatings($product->id)['sumRating'] }}
                                                ({{ $product->product_ratings_count }} ulasan)</span>
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
                                <div class="product-package">
                                    <div class="product-title">
                                        <h4>Variasi Produk</h4>
                                    </div>
                                    <ul class="select-package">
                                        @foreach ($product->varianProducts as $varianProduct)
                                            @auth
                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                    <li>
                                                        <a href="javascript:void(0)" data-id="{{ $varianProduct->id }}"
                                                            data-sell-price="{{ $varianProduct->sell_price }}"
                                                            data-slug="{{ $varianProduct->slug }}"
                                                            data-name="{{ $varianProduct->name }}"
                                                            data-discount="{{ $product->reseller_discount }}"
                                                            id="varian-product-{{ $varianProduct->id }}"
                                                            class="varian-product">{{ $varianProduct->name }}</a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="javascript:void(0)" data-id="{{ $varianProduct->id }}"
                                                            data-sell-price="{{ $varianProduct->sell_price }}"
                                                            data-slug="{{ $varianProduct->slug }}"
                                                            data-name="{{ $varianProduct->name }}"
                                                            data-discount="{{ $product->discount }}"
                                                            id="varian-product-{{ $varianProduct->id }}"
                                                            class="varian-product">{{ $varianProduct->name }}</a>
                                                    </li>
                                                @endif
                                            @endauth
                                            @guest
                                                <li>
                                                    <a href="javascript:void(0)" data-id="{{ $varianProduct->id }}"
                                                        data-sell-price="{{ $varianProduct->sell_price }}"
                                                        data-slug="{{ $varianProduct->slug }}"
                                                        data-name="{{ $varianProduct->name }}"
                                                        data-discount="{{ $product->discount }}"
                                                        id="varian-product-{{ $varianProduct->id }}"
                                                        class="varian-product">{{ $varianProduct->name }}</a>
                                                </li>
                                            @endguest
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="py-4">
                                    <div class="">
                                        <p>Bagikan Produk: </p>
                                    </div>
                                    @auth
                                        @if (auth()->user()->roles->pluck('name')[0] == 'reseller')
                                            @if ($roleReseller && $checkUser == null)
                                                <div class="d-flex">
                                                    <a class="mx-1" id="copyButton" style="cursor: pointer"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Salin Tautan">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                            fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z" />
                                                        </svg>
                                                    </a>
                                                    <form
                                                        action="{{ route('home.share.product.reseller', ['product' => $product->id, 'code' => $code]) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="url"
                                                            value="{{ $shareButtons['whatsapp'] }}" id="">
                                                        <button type="submit" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title=""
                                                            data-bs-original-title="Bagikan ke whatsapp" class="mx-1"
                                                            style="border: none; background:transparent; padding:0;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                height="30" style="color: green" style="margin: 3px"
                                                                fill="currentColor" class="bi bi-whatsapp"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    <form
                                                        action="{{ route('home.share.product.reseller', ['product' => $product->id, 'code' => $code]) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="url"
                                                            value="{{ $shareButtons['facebook'] }}" id="">
                                                        <button type="submit" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title=""
                                                            data-bs-original-title="Bagikan ke facebook" class="mx-1"
                                                            style="border: none; background:transparent; padding:0;color:#3B5998">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                height="30" fill="currentColor" class="bi bi-facebook"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    <form
                                                        action="{{ route('home.share.product.reseller', ['product' => $product->id, 'code' => $code]) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="url"
                                                            value="{{ $shareButtons['telegram'] }}" id="">
                                                        <button type="submit" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title=""
                                                            data-bs-original-title="Bagikan ke telegram" class="mx-1"
                                                            style="border: none; background:transparent; padding:0;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                                height="30" style="color: #1C93E3" fill="currentColor"
                                                                class="bi bi-telegram" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="">
                                                    <a class="mx-1" id="copyButton" style="cursor: pointer"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Salin Tautan">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                            fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z" />
                                                        </svg>
                                                    </a>
                                                    <a href="{{ $shareButtons['whatsapp'] }}" target="__blank"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                        data-bs-original-title="Bagikan ke whatsapp" class="mx-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                            style="color: green" style="margin: 3px" fill="currentColor"
                                                            class="bi bi-whatsapp" viewBox="0 0 16 16">
                                                            <path
                                                                d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                                        </svg>
                                                    </a>
                                                    <a href="{{ $shareButtons['facebook'] }}" target="__blank"
                                                        class="mx-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="" data-bs-original-title="Bagikan ke facebook">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                            fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                                        </svg>
                                                    </a>
                                                    <a href="{{ $shareButtons['telegram'] }}" target="__blank"
                                                        class="mx-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="" data-bs-original-title="Bagikan ke telegram">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                            fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                                                            <path
                                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            @endif
                                        @else
                                            <div class="">
                                                <a class="mx-1" id="copyButton" style="cursor: pointer"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Salin Tautan">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                        fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd"
                                                            d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z" />
                                                    </svg>
                                                </a>
                                                <a href="{{ $shareButtons['whatsapp'] }}" target="__blank"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Bagikan ke whatsapp" class="mx-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                        style="color: green" style="margin: 3px" fill="currentColor"
                                                        class="bi bi-whatsapp" viewBox="0 0 16 16">
                                                        <path
                                                            d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                                    </svg>
                                                </a>
                                                <a href="{{ $shareButtons['facebook'] }}" target="__blank" class="mx-1"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Bagikan ke facebook">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                        fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                                        <path
                                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                                    </svg>
                                                </a>
                                                <a href="{{ $shareButtons['telegram'] }}" target="__blank" class="mx-1"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Bagikan ke telegram">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                        fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                                                        <path
                                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09" />
                                                    </svg>
                                                </a>
                                            </div>
                                        @endif
                                    @endauth
                                    @guest
                                        <div class="">
                                            <a class="mx-1" id="copyButton" style="cursor: pointer"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Salin Tautan">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z" />
                                                </svg>
                                            </a>
                                            <a href="{{ $shareButtons['whatsapp'] }}" target="__blank"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Bagikan ke whatsapp" class="mx-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    style="color: green" style="margin: 3px" fill="currentColor"
                                                    class="bi bi-whatsapp" viewBox="0 0 16 16">
                                                    <path
                                                        d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                                </svg>
                                            </a>
                                            <a href="{{ $shareButtons['facebook'] }}" target="__blank" class="mx-1"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Bagikan ke facebook">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                                </svg>
                                            </a>
                                            <a href="{{ $shareButtons['telegram'] }}" target="__blank" class="mx-1"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                data-bs-original-title="Bagikan ke telegram">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09" />
                                                </svg>
                                            </a>
                                        </div>
                                    @endguest
                                </div>
                            </div>

                            <div class="note-box product-packege mt-5 justify-content-center">
                                @if ($product->status === ProductStatusEnum::AVAILABLE->value)
                                    @if ($product->licenses_count > 0)
                                        @if ($product->varianProducts->first())
                                            <a id="buy-product-varian"
                                                href="{{ route('checkout', [$product->slug, $product->varianProducts[0]->slug]) }}"
                                                class="btn btn-md bg-dark cart-button text-white w-50">Beli Produk</a>
                                        @else
                                            <a href="{{ route('checkout', $product->slug) }}"
                                                class="btn btn-md bg-dark cart-button text-white w-50">Beli Produk</a>
                                        @endif
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
                                        data-bs-target="#question" type="button" role="tab"
                                        aria-controls="question" aria-selected="false">Pertanyaan
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
                                            @if ($product->description)
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
                                            @if ($product->features)
                                                <p>{!! $product->features !!}</p>
                                            @else
                                                <p>Belum ada fitur.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="question" role="tabpanel"
                                    aria-labelledby="question-tab">
                                    <div class="table-responsive">
                                        <table class="table info-table">
                                            @if (count($product->product_questions) > 0)
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
                                            <form method="POST"
                                                action="{{ route('user.addOrUpdateRating', $product->id) }}">
                                                @csrf
                                                @auth
                                                    @if (RatingHelper::checkUserHasTransaction($product->id))
                                                        <div class="col-xl-12">
                                                            @if (RatingHelper::checkUserHasRating($product->id))
                                                                <div class="review-title">
                                                                    <h4 class="fw-500">Ubah Ulasan Anda: </h4>
                                                                </div>

                                                                <div class="row g-4 mt-5">
                                                                    <div class="col-md-6">
                                                                        <div class="form-floating theme-form-floating">
                                                                            <select name="rating" class="form-control">
                                                                                <option
                                                                                    {{ RatingHelper::getUserRating($product->id)->rating == 1 ? 'selected' : '' }}
                                                                                    value="1">
                                                                                    1
                                                                                </option>
                                                                                <option
                                                                                    {{ RatingHelper::getUserRating($product->id)->rating == 2 ? 'selected' : '' }}
                                                                                    value="2">
                                                                                    2
                                                                                </option>
                                                                                <option
                                                                                    {{ RatingHelper::getUserRating($product->id)->rating == 3 ? 'selected' : '' }}
                                                                                    value="3">
                                                                                    3
                                                                                </option>
                                                                                <option
                                                                                    {{ RatingHelper::getUserRating($product->id)->rating == 4 ? 'selected' : '' }}
                                                                                    value="4">
                                                                                    4
                                                                                </option>
                                                                                <option
                                                                                    {{ RatingHelper::getUserRating($product->id)->rating == 5 ? 'selected' : '' }}
                                                                                    value="5">
                                                                                    5
                                                                                </option>
                                                                            </select>
                                                                            <label for="rating">Rating</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-floating theme-form-floating">
                                                                            <textarea name="review" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                                                                style="height: 150px">{{ RatingHelper::getUserRating($product->id)->review }}</textarea>
                                                                            <label for="floatingTextarea2">Komentar
                                                                                Anda</label>
                                                                        </div>
                                                                    </div>
                                                                    @if (RatingStatusEnum::APPROVED->value == RatingHelper::getUserRating($product->id)->status)
                                                                        <div class="col-md-6">
                                                                            <div class="form-floating theme-form-floating">
                                                                                <button type="submit" name="submit"
                                                                                    class="btn btn-md bg-dark cart-button text-white w-50">
                                                                                    Update Ulasan
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <div class="col-md-12">
                                                                            <div class="form-floating theme-form-floating">
                                                                                <button type="button"
                                                                                    class="btn btn-md bg-danger cart-button text-white w-70">
                                                                                    Fitur dimatikan karna anda
                                                                                    melanggar syarat dan ketentuan.
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @else
                                                                <div class="review-title">
                                                                    <h4 class="fw-500">Tambah Ulasan: </h4>
                                                                </div>
                                                                <div class="row g-4 mt-3">
                                                                    <div class="col-md-6">
                                                                        <div class="form-floating theme-form-floating">
                                                                            <select name="rating" class="form-control">
                                                                                <option
                                                                                    {{ old('rating') == 1 ? 'selected' : '' }}
                                                                                    value="1">
                                                                                    1
                                                                                </option>
                                                                                <option
                                                                                    {{ old('rating') == 2 ? 'selected' : '' }}
                                                                                    value="2">
                                                                                    2
                                                                                </option>
                                                                                <option
                                                                                    {{ old('rating') == 3 ? 'selected' : '' }}
                                                                                    value="3">
                                                                                    3
                                                                                </option>
                                                                                <option
                                                                                    {{ old('rating') == 4 ? 'selected' : '' }}
                                                                                    value="4">
                                                                                    4
                                                                                </option>
                                                                                <option
                                                                                    {{ old('rating') == 5 ? 'selected' : '' }}
                                                                                    value="5">
                                                                                    5
                                                                                </option>
                                                                            </select>
                                                                            <label for="rating">Rating</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <div class="form-floating theme-form-floating">
                                                                            <textarea name="review" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                                                                style="height: 150px">{{ old('review') }}</textarea>
                                                                            <label for="floatingTextarea2">Komentar
                                                                                Anda</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-floating theme-form-floating">
                                                                            <button type="submit" name="submit"
                                                                                class="btn btn-md bg-dark cart-button text-white w-50">
                                                                                Tambah ulasan baru
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endauth
                                            </form>

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
                                                                            @if ($rating->user->photo)
                                                                                <img src="{{ asset('storage/' . $rating->user->photo) }}"
                                                                                    class="img-fluid blur-up lazyload"
                                                                                    alt="{{ $rating->user->name }}">
                                                                            @else
                                                                                <img src="{{ asset('avatar.png') }}"
                                                                                    class="img-fluid blur-up lazyload"
                                                                                    alt="{{ $rating->user->name }}">
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="people-comment">
                                                                        <a class="name"
                                                                            href="#">{{ $rating->user->name }}</a>
                                                                        <div class="date-time">
                                                                            <h6 class="text-content">
                                                                                Terakhir
                                                                                dirubah:
                                                                                {{ Carbon::parse($rating->updated_at)->translatedFormat('d F Y H:i') }}
                                                                            </h6>

                                                                            <div class="product-rating">
                                                                                <ul class="rating">
                                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                                        <li>

                                                                                            @if ($i <= $rating->rating)
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
                                    @foreach ($recommendProducts as $product)
                                        <li>
                                            <div class="offer-product">
                                                <a href="{{ route('home.products.show', $product->slug) }}"
                                                    class="offer-image">
                                                    <img src="{{ asset('storage/' . $product->photo) }}"
                                                        class="img-fluid blur-up lazyloaded" alt="{{ $product->name }}">
                                                </a>

                                                <div class="offer-detail">
                                                    <div>
                                                        <a href="{{ route('home.products.show', $product->slug) }}">
                                                            <h6 class="name">{{ $product->name }}</h6>
                                                        </a>
                                                        <span>{{ $product->category->name }}</span>
                                                        <h6 class="price theme-color">
                                                            @if ($product->varianProducts->isEmpty())
                                                                @auth
                                                                    @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                                        <span
                                                                            class="theme-color">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->reseller_discount, true) }}</span>
                                                                        @if ($product->discount != 0)
                                                                            <del
                                                                                class="text-discount">{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                                        @endif
                                                                    @else
                                                                        <span
                                                                            class="theme-color">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}</span>
                                                                        @if ($product->discount != 0)
                                                                            <del
                                                                                class="text-discount">{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    <span
                                                                        class="theme-color">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}</span>
                                                                    @if ($product->discount != 0)
                                                                        <del
                                                                            class="text-discount">{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                                    @endif
                                                                @endauth
                                                            @else
                                                                @auth
                                                                    @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                                        <span
                                                                            class="theme-color">{{ CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($product->varianProducts), $product->reseller_discount, true) }}</span>
                                                                        @if ($product->discount != 0)
                                                                            <del
                                                                                class="text-discount">{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($product->varianProducts)) }}</del>
                                                                        @endif
                                                                    @else
                                                                        <span
                                                                            class="theme-color">{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($product->varianProducts), $product->discount)) }}</span>
                                                                        @if ($product->discount != 0)
                                                                            <del
                                                                                class="text-discount">{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($product->varianProducts)) }}</del>
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    <span
                                                                        class="theme-color">{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($product->varianProducts), $product->discount)) }}</span>
                                                                    @if ($product->discount != 0)
                                                                        <del
                                                                            class="text-discount">{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($product->varianProducts)) }}</del>
                                                                    @endif
                                                                @endauth
                                                            @endif
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
                                        <a href="{{ route('home.products.show', $product->slug) }}" tabindex="-1">
                                            <img src="{{ asset('storage/' . $product->photo) }}"
                                                class="img-fluid blur-up lazyloaded" alt="{{ $product->name }}">
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
                                            {{ strlen($product->name) > 15 ? substr($product->name, 0, 18) . '...' : $product->name }}
                                        </h5>
                                        <div class="product-rating mt-2">
                                            <ul class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <li>
                                                        @if ($i <= RatingHelper::sumProductRatings($product->id)['stars'])
                                                            <i data-feather="star" class="fill"></i>
                                                        @else
                                                            <i data-feather="star"></i>
                                                        @endif
                                                    </li>
                                                @endfor

                                            </ul>
                                            @if (RatingHelper::sumProductRatings($product->id)['sumRating'] == 0)
                                                <span>(0 ulasan)</span>
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
                                                    <span class="badge rounded-pill text-bg-danger">Preorder</span>
                                                </h4>
                                            @endif
                                        </h6>
                                        <h5 class="price mt-3">
                                            @guest
                                                <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                <br>
                                                <span
                                                    class="theme-color">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}</span>
                                            @else
                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                    <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                    <br>
                                                    <span
                                                        class="theme-color">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->reseller_discount, true) }}</span>
                                                @else
                                                    <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                    <br>
                                                    <span
                                                        class="theme-color">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}</span>
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
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#copyButton').click(function() {
                var urlToCopy =
                    '{{ URL::current() }}';
                navigator.clipboard.writeText(urlToCopy).then(function() {
                    alert('Tautan berhasil disalin!');
                }, function(err) {
                    console.error('Gagal menyalin tautan: ', err);
                    alert('Gagal menyalin tautan. Silakan coba lagi.');
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.varian-product').click(function() {
                $('.hidden-product').attr('style', 'display: none');
                $('.varian-product').removeClass('active');
                $(this).addClass('active');
                var sellPrice = parseFloat($(this).data(
                    'sell-price'));
                var discount = parseFloat($(this).data('discount'));
                var formattedPrice = formatCurrency(sellPrice);
                var discountPrice = discountCurrency(sellPrice, discount);
                var slug = $(this).data('slug');
                $("#buy-product-varian").attr("href", "{{ route('checkout', [$product->slug, '']) }}/" +
                    slug);
                $('#discount-price').text(formatCurrency(discountPrice));
                $('#price-product').text(formattedPrice);
            });

            function formatCurrency(price) {
                return 'Rp ' + price.toLocaleString('id-ID', {
                    minimumFractionDigits: 2
                });
            }

            function discountCurrency(price, discount) {
                let total = price - (price * (discount / 100));
                return total;
            }
        });
    </script>
    <script src="{{ asset('assets/js/script-select-package.js') }}"></script>
@endsection
