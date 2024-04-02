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
                                @auth
                                    @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                        @if ($product->discount > 0)
                                            <h6 class="offer-top">Diskon : {{ $product->reseller_discount . '%' }}</h6>
                                        @endif
                                    @else
                                        @if ($product->discount > 0)
                                            <h6 class="offer-top">Diskon : {{ $product->discount . '%' }}</h6>
                                        @endif
                                    @endif
                                @else
                                    @if ($product->discount > 0)
                                        <h6 class="offer-top">Diskon : {{ $product->discount . '%' }}</h6>
                                    @endif
                                @endauth


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
                                                {{-- <span class="hidden-product review mx-2">||</span>
                                                <span
                                                    class="hidden-product review">{{ $product->varianProducts[0]->name }}</span> --}}
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
                                                    {{-- <span class="hidden-product review mx-2">||</span>
                                                    <span
                                                        class="hidden-product review">{{ $product->varianProducts[0]->name }}</span> --}}
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
                                                    {{-- <span class="hidden-product review mx-2">||</span>
                                                    <span
                                                        class="hidden-product review">{{ $product->varianProducts[0]->name }}</span> --}}
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

                                </div>
                                @if ($product->varianProducts->isNotEmpty())
                                    <div class="product-package">
                                        <div class="product-title">
                                            <h4>Variasi Produk</h4>
                                        </div>
                                        <ul class="select-package">
                                            @if ($user)
                                                @foreach ($product->varianProducts as $index => $varianProduct)
                                                    @auth
                                                        @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                            <li>
                                                                <a href="javascript:void(0)" data-id="{{ $varianProduct->id }}"
                                                                    data-sell-price="{{ $varianProduct->sell_price }}"
                                                                    data-user="{{ $user->code_affiliate }}"
                                                                    data-slug="{{ $varianProduct->slug }}"
                                                                    data-name="{{ $varianProduct->name }}"
                                                                    data-product = "{{ $product->slug }}"
                                                                    data-discount="{{ $product->reseller_discount }}"
                                                                    id="varian-product-{{ $varianProduct->id }}"
                                                                    class="varian-product{{ $index == 0 ? ' active' : '' }}">{{ $varianProduct->name }}</a>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a href="javascript:void(0)" data-id="{{ $varianProduct->id }}"
                                                                    data-sell-price="{{ $varianProduct->sell_price }}"
                                                                    data-user="{{ $user->code_affiliate }}"
                                                                    data-slug="{{ $varianProduct->slug }}"
                                                                    data-product = "{{ $product->slug }}"
                                                                    data-name="{{ $varianProduct->name }}"
                                                                    data-discount="{{ $product->discount }}"
                                                                    id="varian-product-{{ $varianProduct->id }}"
                                                                    class="varian-product{{ $index == 0 ? ' active' : '' }}">{{ $varianProduct->name }}</a>
                                                            </li>
                                                        @endif
                                                    @endauth
                                                    @guest
                                                        <li>
                                                            <a href="javascript:void(0)" data-id="{{ $varianProduct->id }}"
                                                                data-sell-price="{{ $varianProduct->sell_price }}"
                                                                data-user="{{ $user->code_affiliate }}"
                                                                data-product = "{{ $product->slug }}"
                                                                data-slug="{{ $varianProduct->slug }}"
                                                                data-name="{{ $varianProduct->name }}"
                                                                data-discount="{{ $product->discount }}"
                                                                id="varian-product-{{ $varianProduct->id }}"
                                                                class="varian-product{{ $index == 0 ? ' active' : '' }}">{{ $varianProduct->name }}</a>
                                                        </li>
                                                    @endguest
                                                @endforeach
                                            @else
                                                @foreach ($product->varianProducts as $index => $varianProduct)
                                                    @auth
                                                        @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    data-id="{{ $varianProduct->id }}"
                                                                    data-sell-price="{{ $varianProduct->sell_price }}"
                                                                    data-slug="{{ $varianProduct->slug }}"
                                                                    data-name="{{ $varianProduct->name }}"
                                                                    data-product = "{{ $product->slug }}"
                                                                    data-discount="{{ $product->reseller_discount }}"
                                                                    id="varian-product-{{ $varianProduct->id }}"
                                                                    class="varian-product{{ $index == 0 ? ' active' : '' }}">{{ $varianProduct->name }}</a>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    data-id="{{ $varianProduct->id }}"
                                                                    data-sell-price="{{ $varianProduct->sell_price }}"
                                                                    data-slug="{{ $varianProduct->slug }}"
                                                                    data-product = "{{ $product->slug }}"
                                                                    data-name="{{ $varianProduct->name }}"
                                                                    data-discount="{{ $product->discount }}"
                                                                    id="varian-product-{{ $varianProduct->id }}"
                                                                    class="varian-product{{ $index == 0 ? ' active' : '' }}">{{ $varianProduct->name }}</a>
                                                            </li>
                                                        @endif
                                                    @endauth
                                                    @guest
                                                        <li>
                                                            <a href="javascript:void(0)" data-id="{{ $varianProduct->id }}"
                                                                data-sell-price="{{ $varianProduct->sell_price }}"
                                                                data-product = "{{ $product->slug }}"
                                                                data-slug="{{ $varianProduct->slug }}"
                                                                data-name="{{ $varianProduct->name }}"
                                                                data-discount="{{ $product->discount }}"
                                                                id="varian-product-{{ $varianProduct->id }}"
                                                                class="varian-product{{ $index == 0 ? ' active' : '' }}">{{ $varianProduct->name }}</a>
                                                        </li>
                                                    @endguest
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                                <div class="py-4">
                                    <div class="">
                                        <p>Bagikan Produk: </p>
                                    </div>
                                    @auth
                                        @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                            <div class="">
                                                <a class="mx-1" id="copyButton" data-code="{{ $code }}"
                                                    style="cursor: pointer" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="" data-bs-original-title="Salin Tautan">
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
                                        @if ($user)
                                            @if ($product->varianProducts->first())
                                                <a id="buy-product-varian"
                                                    href="{{ route('checkout.products', [$product->slug, $user->code_affiliate, $product->varianProducts[0]->slug]) }}"
                                                    class="btn btn-md theme-bg-color cart-button text-white w-50">Beli Produk</a>
                                            @else
                                                <a href="{{ route('checkout.products', [$product->slug, $user->code_affiliate]) }}"
                                                    class="btn btn-md theme-bg-color cart-button text-white w-50">Beli Produk</a>
                                            @endif
                                        @else
                                            @if ($product->varianProducts->first())
                                                <a id="buy-product-varian"
                                                    href="{{ route('checkout', [$product->slug, $product->varianProducts[0]->slug]) }}"
                                                    class="btn btn-md theme-bg-color cart-button text-white w-50">Beli Produk</a>
                                            @else
                                                <a href="{{ route('checkout', $product->slug) }}"
                                                    class="btn btn-md theme-bg-color cart-button text-white w-50">Beli Produk</a>
                                            @endif
                                        @endif
                                    @else
                                        <button class="btn btn-md bg-danger cart-button text-white w-50">Stok produk
                                            telah habis
                                        </button>
                                    @endif
                                @else
                                    @if ($user)
                                        @if ($product->varianProducts->first())
                                            <a id="buy-product-varian"
                                                href="{{ route('checkout.products', [$product->slug, $user->code_affiliate, $product->varianProducts[0]->slug]) }}"
                                                class="btn btn-md theme-bg-color cart-button text-white w-50">Beli Produk</a>
                                        @else
                                            <a href="{{ route('checkout.products', [$product->slug, $user->code_affiliate]) }}"
                                                class="btn btn-md theme-bg-color cart-button text-white w-50">Beli Produk</a>
                                        @endif
                                    @else
                                        @if ($product->varianProducts->first())
                                            <a id="buy-product-varian"
                                                href="{{ route('checkout', [$product->slug, $product->varianProducts[0]->slug]) }}"
                                                class="btn btn-md theme-bg-color cart-button text-white w-50">Beli Produk</a>
                                        @else
                                            <a href="{{ route('checkout', $product->slug) }}"
                                                class="btn btn-md theme-bg-color cart-button text-white w-50">Beli Produk</a>
                                        @endif
                                    @endif

                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="product-section-box">
                            <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button style="font-size:15px;" class="nav-link active" id="description-tab"
                                        data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab"
                                        aria-controls="description" aria-selected="true">Deskripsi
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button style="font-size:15px;" class="nav-link" id="info-tab" data-bs-toggle="tab"
                                        data-bs-target="#info" type="button" role="tab" aria-controls="info"
                                        aria-selected="false">Fitur
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button style="font-size:15px;" class="nav-link" id="question-tab"
                                        data-bs-toggle="tab" data-bs-target="#question" type="button" role="tab"
                                        aria-controls="question" aria-selected="false">FAQ
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button style="font-size:15px;" class="nav-link" id="care-tab" data-bs-toggle="tab"
                                        data-bs-target="#care" type="button" role="tab" aria-controls="care"
                                        aria-selected="false">Cara Penggunaan
                                    </button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button style="font-size:15px;" class="nav-link" id="review-tab"
                                        data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab"
                                        aria-controls="review" aria-selected="false">Ulasan Pelanggan
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
                                    @forelse ($product->product_questions as $question) 
                                    <div class="">
                                        <h4 class="fw-bold">{{$question->question}}</h4>
                                        <p>{{$question->answer}}</p>
                                    </div>
                                    @empty
                                        <p>Belum ada pertanyaan.</p>
                                    @endforelse
                                    {{-- <div class="table-responsive">
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
                                    </div> --}}
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
                                                                                    class="btn btn-md theme-bg-color cart-button text-white w-50">
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
                                                                                class="btn btn-md theme-bg-color cart-button text-white w-50">
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
    <x-share-modal></x-share-modal>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#copyButton').click(function() {
                var currentURL = '{{ URL::current() }}';
                var dataCode = $(this).data('code');
                if (dataCode) {
                    var urlToCopy = currentURL + '/' + dataCode;
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
    <script>
        $(document).ready(function() {
            $('.varian-product').click(function() {
                $('.hidden-product').attr('style', 'display: none');
                $('.varian-product').removeClass('active');
                $(this).addClass('active');
                var sellPrice = parseFloat($(this).data(
                    'sell-price'));
                var discount = parseFloat($(this).data('discount'));
                var code = $(this).data('user');
                var formattedPrice = formatCurrency(sellPrice);
                var discountPrice = discountCurrency(sellPrice, discount);
                var product = $(this).data("product");
                var slug = $(this).data('slug');
                if (code) {
                    $("#buy-product-varian").attr("href",
                        "{{ route('checkout.products', ['', '', '']) }}/" + product + "/" + code +
                        "/" + slug);
                } else {
                    $("#buy-product-varian").attr("href",
                        "{{ route('checkout', ['', '']) }}/" + product + "/" + slug);

                }

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
    <script>
        $(document).on('click', '#shareButtonsTrigger', function() {
            var slug = $(this).data('slug');
            $('#shareProductModal').modal('show');

            $.ajax({
                url: "{{ route('home.share.product') }}" + "/" + slug,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    // Gunakan data yang diterima dari server (misalnya, update href)
                    $('#shareLinkButton').attr('href', response.data.getRawLinks);
                    $('#shareWhatsappButton').attr('href', response.data.whatsapp);
                    $('#shareFacebookButton').attr('href', response.data.facebook);
                    $('#shareTelegramButton').attr('href', response.data.telegram);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });

            $('#shareLinkButton').click(function() {
                // Perhatikan penggunaan URL::to() untuk mendapatkan URL lengkap
                var urlToCopy = "{{ URL::to('/products') }}/" + slug;
                navigator.clipboard.writeText(urlToCopy).then(function() {
                    alert('Tautan berhasil disalin!');
                }, function(err) {
                    console.error('Gagal menyalin tautan: ', err);
                    alert('Gagal menyalin tautan. Silakan coba lagi.');
                });
            });
        });
    </script>
    <script src="{{ asset('assets/js/script-select-package.js') }}"></script>
@endsection
