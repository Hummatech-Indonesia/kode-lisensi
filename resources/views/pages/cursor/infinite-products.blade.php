@php use App\Enums\ProductStatusEnum;use App\Enums\UserRoleEnum;use App\Helpers\CurrencyHelper;use App\Helpers\RatingHelper;use App\Helpers\UserHelper; @endphp
@forelse($products as $product)
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
                    <h5 class="name">{{ $product->name }}</h5>
                    <div class="product-rating mt-2">
                        <ul class="rating">
                            @for($i = 1; $i <= 5; $i++)
                                <li>
                                    @if($i <= RatingHelper::sumProductRatings($product->id)['stars'])
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                             height="24" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-star fill">
                                            <polygon
                                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                             height="24" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-star">
                                            <polygon
                                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                        </svg>
                                    @endif
                                </li>
                            @endfor

                        </ul>
                        @if(RatingHelper::sumProductRatings($product->id)['sumRating'] == 0)
                            <span>(Belum ada ulasan)</span>

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
@empty
    <p class="loopProducts">Data dengan filter yang dipilih tidak ditemukan</p>
@endforelse
