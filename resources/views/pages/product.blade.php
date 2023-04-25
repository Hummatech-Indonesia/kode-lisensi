@php use App\Enums\ProductStatusEnum;use App\Enums\UserRoleEnum;use App\Helpers\CurrencyHelper;use App\Helpers\UserHelper; @endphp
@extends('layouts.main')
@section('content')
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Produk Kami</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home.index') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Produk</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-custome-3">
                    <div class="left-box wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="shop-left-sidebar">
                            <div class="back-button">
                                <h3><i class="fa-solid fa-arrow-left"></i> Back</h3>
                            </div>
                            <div class="filter-category">
                                <div class="filter-title">
                                    <h2>Pengaturan</h2>
                                    <a href="{{ route('home.products.index') }}">Hapus Filter</a>
                                </div>

                                <button id="setFilter"
                                        class="mt-3 btn theme-bg-color btn-sm text-white fw-bold mt-md-4 mt-2 mend-auto">
                                    Update Filter
                                </button>
                            </div>

                            <div class="accordion custome-accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                            <span>Filter</span>
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse show"
                                         aria-labelledby="panelsStayOpen-headingTwo">
                                        <div class="accordion-body">
                                            <ul class="category-list custom-padding">
                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input name="productStatusFilter" value="stocking"
                                                               class="checkbox_animated"
                                                               type="checkbox" id="stocking">
                                                        <label class="form-check-label" for="stocking">
                                                            <span class="name">Tersedia</span>
                                                        </label>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input name="productStatusFilter" value="preorder"
                                                               class="checkbox_animated"
                                                               type="checkbox" id="preorder">
                                                        <label class="form-check-label" for="preorder">
                                                            <span class="name">Preorder</span>
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                aria-expanded="false" aria-controls="collapseOne">
                                            <span>Kategori</span>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                         aria-labelledby="headingOne" style="">
                                        <div class="accordion-body">
                                            <ul class="category-list custom-padding custom-height">
                                                @foreach($categories as $category)
                                                    <li>
                                                        <div class="form-check ps-0 m-0 category-list-box">
                                                            <input value="{{ $category->id }}" name="categoryFilter"
                                                                   class="checkbox_animated"
                                                                   type="checkbox">
                                                            <label class="form-check-label" for="fruit">
                                                                <span class="name">{{ $category->name }}</span>
                                                                <span
                                                                    class="number">({{ $category->products_count }})</span>
                                                            </label>
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
                </div>

                <div class="col-custome-9">
                    <div class="show-button">
                        <div class="filter-button-group mt-0">
                            <div class="filter-button d-inline-block d-lg-none">
                                <a><i class="fa-solid fa-filter"></i> Filter Menu</a>
                            </div>
                        </div>
                    </div>

                    <div id="productContainer"
                         class="row g-sm-4 g-3 product-list-section row-cols-xxl-3 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2">
                        @foreach($products as $product)
                            <div class="loopProducts">
                                <div class="product-box-3 h-100 wow fadeInUp"
                                     style="visibility: visible; animation-name: fadeInUp;">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <img src="{{ asset('storage/'. $product->photo) }}"
                                                 class="img-fluid blur-up lazyloaded" alt="">
                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Lihat Produk">
                                                    <a href="{{ route('home.products.show', $product->slug) }}"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#view">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round"
                                                             class="feather feather-eye">
                                                            <path
                                                                d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                        </svg>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Bandingkan Produk">
                                                    <a href="compare.html">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round"
                                                             class="feather feather-refresh-cw">
                                                            <polyline points="23 4 23 10 17 10"></polyline>
                                                            <polyline points="1 20 1 14 7 14"></polyline>
                                                            <path
                                                                d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                                                        </svg>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Favorit">
                                                    <a href="wishlist.html" class="notifi-wishlist">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round"
                                                             class="feather feather-heart">
                                                            <path
                                                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                        </svg>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">{{ $product->category->name }}</span>
                                            <h5 class="name">{{ $product->name }}</h5>
                                            <p class="text-content mt-1 mb-2 product-content">Cheesy feet cheesy grin
                                                brie.
                                                Mascarpone cheese and wine hard cheese the big cheese everyone loves
                                                smelly
                                                cheese macaroni cheese croque monsieur.</p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    <li>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round"
                                                             class="feather feather-star">
                                                            <polygon
                                                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                        </svg>
                                                    </li>
                                                </ul>
                                                <span>(4.0)</span>
                                            </div>
                                            <h6 class="unit">
                                                @if($product->status === ProductStatusEnum::AVAILABLE->value)
                                                    @if($product->licenses_count > 0)
                                                        <h4>
                                                            <span class="badge rounded-pill text-bg-success"> Tersedia: {{ $product->licenses_count }} Stok</span>
                                                        </h4>
                                                    @else
                                                        <h4>
                                                            <span class="badge rounded-pill text-bg-danger">Produk telah habis</span>
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
                                                    <span
                                                        class="theme-color">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount,true) }}</span>
                                                    <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                @else
                                                    @if(UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                        <span
                                                            class="theme-color">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->reseller_discount,true) }}</span>
                                                        <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                    @else
                                                        <span
                                                            class="theme-color">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount,true) }}</span>
                                                        <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                    @endif
                                                @endguest

                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div id="next-products"></div>
                        <div id="next-cursor" style="display: none">{{ $nextCursor }}</div>
                        @if($nextCursor)
                            <div class="row" id="loadMoreContainer">
                                <button id="btnLoadMore"
                                        class="text-center rounded-pill mt-3 btn theme-bg-color btn-sm text-white fw-bold mt-md-4 mt-2 mend-auto">
                                    Load More Data..
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(() => {

            let url = window.location.href
            let filter = []
            let categories = []

            const infiniteLoadMore = (nextCursor) => {
                $.ajax({
                    url: url + "?cursor=" + nextCursor,
                    responseType: "json",
                    method: 'get',
                    data: {
                        nextCursor: nextCursor,
                        filter: filter,
                        categories: categories
                    },
                    success: (response) => {
                        document.getElementById('next-products').insertAdjacentHTML('beforebegin', response.data.html)
                        document.getElementById('next-cursor').innerHTML = response.data.nextCursor

                        if (response.data.nextCursor == null || Object.keys(response.data.nextCursor).length === 0) {
                            $('#loadMoreContainer').css('display', 'none')
                        } else {
                            $('#loadMoreContainer').css('display', 'block')
                        }
                    },
                    error: (err) => {
                        console.log(err)
                    }
                })
            }

            $('#btnLoadMore').on('click', function (e) {
                e.preventDefault()
                let nextCursor = document.getElementById('next-cursor').innerHTML || null
                if (nextCursor) infiniteLoadMore(nextCursor);

            })

            $('#setFilter').on('click', function (e) {
                e.preventDefault()

                filter = []
                categories = []

                let filterCheck = document.querySelectorAll('input[name=productStatusFilter]:checked')

                for (let i = 0; i < filterCheck.length; i++) {
                    if (filterCheck[i].value !== "on") {
                        filter.push(filterCheck[i].value)
                    }
                }

                let categoryCheck = document.querySelectorAll('input[name=categoryFilter]:checked')

                for (let i = 0; i < categoryCheck.length; i++) {
                    if (categoryCheck[i].value !== "on") {
                        categories.push(categoryCheck[i].value)
                    }
                }

                $.ajax({
                    url: url,
                    responseType: "json",
                    method: 'get',
                    data: {
                        filter: filter,
                        categories: categories
                    },
                    success: (response) => {
                        $('.loopProducts').remove()
                        document.getElementById('next-products').insertAdjacentHTML('beforebegin', response.data.html)
                        document.getElementById('next-cursor').innerHTML = response.data.nextCursor

                        if (response.data.nextCursor == null || Object.keys(response.data.nextCursor).length === 0) {
                            $('#loadMoreContainer').css('display', 'none')
                        } else {
                            $('#loadMoreContainer').css('display', 'block')
                        }
                    },
                    error: (err) => {
                        console.log(err)
                    }
                })
            })
        })
    </script>
@endsection
