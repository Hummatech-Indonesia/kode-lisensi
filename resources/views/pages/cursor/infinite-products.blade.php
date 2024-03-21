@php
    use App\Enums\ProductStatusEnum;
    use App\Enums\UserRoleEnum;
    use App\Helpers\CurrencyHelper;
    use App\Helpers\RatingHelper;
    use App\Helpers\UserHelper;
@endphp
@forelse($products as $product)
    <div class="loopProducts">
        <div class="product-box-3 h-100 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
            <div class="product-header">
                <div class="product-image">
                    <a href="{{ route('home.products.show', $product->slug) }}">
                        <img src="{{ asset('storage/' . $product->photo) }}" class="img-fluid blur-up lazyloaded"
                            alt="">
                    </a>
                    <ul class="product-option">
                        <li data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="Lihat Produk">
                            <a href="{{ route('home.products.show', $product->slug) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                    <path
                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                </svg>
                            </a>

                        </li>
                        {{-- pemicu tombol share --}}
                        <li data-bs-toggle="tooltip" data-bs-original-title="Bagikan Produk">
                            <a data-bs-toggle="modal" data-bs-target="#shareProductModal"
                                data-slug="{{ $product->slug }}" id="shareButtonsTrigger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                                    <path
                                        d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.5 2.5 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5m-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3" />
                                </svg>
                            </a>
                        </li>

                        @auth
                            @if ($product->product_favorites->where('user_id', auth()->user()->id)->first())
                                <li data-bs-toggle="tooltip" class="favorite" data-bs-placement="top" title=""
                                    data-bs-original-title="Favorit">
                                    <a href="" class="delete-favorite" data-id="{{ $product->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            style="color: red" fill="currentColor" class="bi bi-suit-heart-fill"
                                            viewBox="0 0 16 16">
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
                    <h4>{{ $product->category->name }}</h4>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-star fill">
                                            <polygon
                                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                            </polygon>
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
                                <span class="badge rounded-pill text-bg-info text-white">Preorder</span>
                            </h4>
                        @endif
                    </h6>
                </div>
            </div>
        </div>
    </div>
@empty
    <p class="loopProducts">Data dengan filter yang dipilih tidak ditemukan</p>
@endforelse
