@php
    use App\Enums\ProductStatusEnum;
    use App\Enums\UserRoleEnum;
    use App\Helpers\CurrencyHelper;
    use App\Helpers\RatingHelper;
    use App\Helpers\UserHelper;
@endphp
@extends('layouts.main')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
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
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
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
                                                            class="checkbox_animated" type="checkbox" id="stocking">
                                                        <label class="form-check-label" for="stocking">
                                                            <span class="name">Tersedia</span>
                                                        </label>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input name="productStatusFilter" value="preorder"
                                                            class="checkbox_animated" type="checkbox" id="preorder">
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
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            <span>Kategori</span>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" style="">
                                        <div class="accordion-body">
                                            <ul class="category-list custom-padding custom-height">
                                                @foreach ($categories as $category)
                                                    <li>
                                                        <div class="form-check ps-0 m-0 category-list-box">
                                                            <input value="{{ $category->id }}" name="categoryFilter"
                                                                class="checkbox_animated" type="checkbox">
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

                    <div class="col-12 mb-5" id="searchLabelContainer" style="display: none">
                        <h4 id="searchLabel">Menggunakan Kata Kunci Pencarian : </h4>
                    </div>

                    <div id="productContainer"
                        class="row g-sm-4 g-3 product-list-section row-cols-xxl-3 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 mt-3">
                        @forelse($products as $product)
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

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Bandingkan Produk">
                                                    <a href="#">
                                                        <i data-feather="refresh-cw"></i>

                                                    </a>
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
                                            <span class="span-name">{{ $product->category->name }}</span>
                                            <a href="{{ route('home.products.show', $product->slug) }}">
                                                <h5 class="name">{{ $product->name }}</h5>
                                            </a>
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
                                                        <span class="badge rounded-pill text-bg-danger">Preorder</span>
                                                    </h4>
                                                @endif
                                            </h6>
                                            <h5 class="price mt-3">
                                                @if ($product->varianProducts->isEmpty())
                                                @guest
                                                    <span
                                                        class="theme-color">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}</span>
                                                    <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                @else
                                                    @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                        <span
                                                            class="theme-color">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->reseller_discount, true) }}</span>
                                                        <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                    @else
                                                        <span
                                                            class="theme-color">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}</span>
                                                        <del>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</del>
                                                    @endif
                                                @endguest
                                            @else
                                                <span
                                                    class="theme-color">{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount(CurrencyHelper::varianPrice($product->varianProducts), $product->discount)) }}</span>
                                                @if ($product->discount != 0)
                                                    <del>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($product->varianProducts)) }}</del>
                                                @endif
                        @endif

                        </h5>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <p class="loopProducts">Data dengan filter yang dipilih tidak ditemukan</p>
            @endforelse
            <div id="next-products"></div>
            <div id="next-cursor" style="display: none">{{ $nextCursor }}</div>
            @if ($nextCursor)
                <div class="row" id="loadMoreContainer">
                    <button id="btnLoadMore"
                        class="text-center rounded-pill mt-3 btn theme-bg-color btn-sm text-white fw-bold mt-md-4 mt-2 mend-auto">
                        Tampilkan Lebih Banyak..
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(() => {

                let url = window.location.href
                let filter = []
                let categories = []
                let search = $('#inputSearch').val() || null

                const displaySearchLabel = (search) => {
                    $('#searchLabelContainer').css('display', 'block')
                    $('#searchLabel').text('Kata Kunci Pencarian: ' + search)
                }

                if (search) {
                    displaySearchLabel(search)
                }

                $(".filter-button").click(function() {
                    $(".bg-overlay, .left-box").addClass("show");
                });
                $(".back-button, .bg-overlay").click(function() {
                    $(".bg-overlay, .left-box").removeClass("show");
                });

                $(document).ready(function() {
                    $(".sort-by-button").click(function() {
                        $(".top-filter-menu").toggleClass("show");
                    });
                });

                const infiniteLoadMore = (nextCursor) => {
                    search = $('#inputSearch').val() || null

                    if (search) {
                        displaySearchLabel(search)
                    } else {
                        $('#searchLabelContainer').css('display', 'none')
                    }

                    $.ajax({
                        url: url + "?cursor=" + nextCursor,
                        responseType: "json",
                        method: 'get',
                        data: {
                            nextCursor: nextCursor,
                            filter: filter,
                            categories: categories,
                            search: search
                        },
                        success: (response) => {
                            document.getElementById('next-products').insertAdjacentHTML('beforebegin',
                                response.data.html)
                            document.getElementById('next-cursor').innerHTML = response.data.nextCursor

                            if (response.data.nextCursor == null || Object.keys(response.data
                                    .nextCursor).length === 0) {
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

                $('#btnLoadMore').on('click', function(e) {
                    e.preventDefault()
                    let nextCursor = document.getElementById('next-cursor').innerHTML || null
                    if (nextCursor) infiniteLoadMore(nextCursor);

                })

                $('#setFilter').on('click', function(e) {
                    e.preventDefault()

                    filter = []
                    categories = []
                    search = $('#inputSearch').val() || null

                    if (search) {
                        displaySearchLabel(search)
                    } else {
                        $('#searchLabelContainer').css('display', 'none')
                    }

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
                            categories: categories,
                            search: search
                        },
                        success: (response) => {
                            $('.loopProducts').remove()
                            document.getElementById('next-products').insertAdjacentHTML(
                                'beforebegin', response.data.html)
                            document.getElementById('next-cursor').innerHTML = response.data
                                .nextCursor

                            if (response.data.nextCursor == null || Object.keys(response.data
                                    .nextCursor).length === 0) {
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
                            console.log(response.message);
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
                            console.log(response.message);
                        },
                        error: function(xhr, status, error) {
                            console.error("Terjadi kesalahan: " + error);
                        }
                    });
                });
            });
        </script>
    @endsection
