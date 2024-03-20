@extends('dashboard.layouts.app')
@section('css')
@endsection
@section('content')
    @php
        use App\Enums\InvoiceStatusEnum;
        use App\Enums\ProductStatusEnum;
        use App\Enums\UserRoleEnum;
        use App\Helpers\CurrencyHelper;
        use App\Helpers\RatingHelper;
        use App\Helpers\UserHelper;
        use App\Helpers\UserSummaryHelper;
        use Carbon\Carbon;
        use App\Helpers\NotificationHelper;
        $take = 5;
        $notifications = NotificationHelper::take($take);
        $totalNotifications = NotificationHelper::count();
    @endphp
    <div class="">
        <div class="dashboard-order">
            <div class="title">
                <h2 class="mb-4">Riwayat Transaksi</h2>
            </div>

            <div class="col-xxl-12 mb-4">
                <div class="alert alert-warning">
                    Catatan: <br>
                    Ulasan hanya bisa ditulis sebanyak satu kali tiap jenis produk yang berhasil
                    dibeli.
                    <br>
                    Ulasan yang telah dikirim tidak bisa dihapus maupun diedit.

                </div>
            </div>

            <div class="order-contain">
                @forelse(UserSummaryHelper::latestUserTransaction() as $trans)
                    <div class="order-box dashboard-bg-box">
                        <div class="order-container">
                            <div class="order-icon">
                                <i data-feather="box"></i>
                            </div>

                            <div class="order-detail">
                                <h4> {{ $trans->invoice_id }}
                                    @if (
                                        $trans->invoice_status == InvoiceStatusEnum::FAILED->value ||
                                            $trans->invoice_status == InvoiceStatusEnum::EXPIRED->value)
                                        <span>Dibatalkan</span>
                                    @elseif(
                                        $trans->invoice_status == InvoiceStatusEnum::PAID->value ||
                                            $trans->invoice_status == InvoiceStatusEnum::SETTLED->value)
                                        <span class="success-bg">Lunas</span>
                                    @else
                                        <span>Pending</span>
                                    @endif
                                </h4>
                                <h6 class="text-content">Total
                                    Harga: {{ CurrencyHelper::rupiahCurrency($trans->amount) }}
                                </h6>
                            </div>
                        </div>

                        <div class="product-order-detail">
                            <a href="{{ route('home.products.show', $trans->detail_transaction->product->slug) }}"
                                class="order-image">
                                <img style="max-height: 200px; max-width: 200px;"
                                    src="{{ asset('storage/' . $trans->detail_transaction->product->photo) }}"
                                    class="blur-up lazyloaded" alt="{{ $trans->detail_transaction->product->name }}">
                            </a>

                            <div class="order-wrap">
                                <a href="{{ route('home.products.show', $trans->detail_transaction->product->slug) }}">
                                    <h3>{{ $trans->detail_transaction->product->name }}</h3>
                                </a>
                                <p class="text-content">
                                    {{ $trans->detail_transaction->product->short_description }}
                                </p>
                                <ul class="product-size">
                                    <li>
                                        <div class="size-box">
                                            <h6 class="text-content">Harga : </h6>
                                            <h5>
                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                    @if (!$trans->detail_transaction->varianProduct)
                                                        {{ CurrencyHelper::rupiahCurrency($trans->amount) }}
                                                        <span>({{ $trans->detail_transaction->varianProduct->name }})</span>
                                                    @else
                                                        {{ CurrencyHelper::rupiahCurrency($trans->amount) }}
                                                    @endif
                                                @else
                                                    @if ($trans->detail_transaction->varianProduct)
                                                        {{ CurrencyHelper::rupiahCurrency($trans->amount) }}
                                                        <span>({{ $trans->detail_transaction->varianProduct->name }})</span>
                                                    @else
                                                        {{ CurrencyHelper::rupiahCurrency($trans->amount) }}
                                                    @endif
                                                @endif
                                            </h5>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="size-box">
                                            <h6 class="text-content">Rate : </h6>
                                            <div class="product-rating ms-2">
                                                <ul class="rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <li>
                                                            @if ($i <= RatingHelper::sumProductRatings($trans->detail_transaction->product->id)['stars'])
                                                                <i data-feather="star" class="fill"></i>
                                                            @else
                                                                <i data-feather="star"></i>
                                                            @endif
                                                        </li>
                                                    @endfor

                                                </ul>
                                                @if (RatingHelper::sumProductRatings($trans->detail_transaction->product->id)['sumRating'] == 0)
                                                    <span>(Belum ada ulasan)</span>
                                                @else
                                                    <span>{{ RatingHelper::sumProductRatings($trans->detail_transaction->product->id)['sumRating'] }}
                                                        ({{ $trans->detail_transaction->product->product_ratings_count }}
                                                        ulasan)
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="size-box">
                                            <h6 class="text-content">Jenis Produk : </h6>
                                            <h5>
                                                @if ($trans->detail_transaction->product->status === ProductStatusEnum::AVAILABLE->value)
                                                    Tersedia
                                                @else
                                                    Preorder
                                                @endif
                                            </h5>
                                        </div>
                                    </li>

                                    <li class="mt-3">
                                        <div class="size-box">
                                            @if (RatingHelper::checkUserHasRating($trans->detail_transaction->product->id))
                                                <a href="{{ route('home.products.show', $trans->detail_transaction->product->slug) }}"
                                                    class="btn btn-success btn-sm text-white">
                                                    Cek Ulasan Saya
                                                </a>
                                            @else
                                                <a href="{{ route('home.products.show', $trans->detail_transaction->product->slug) }}"
                                                    class="btn btn-danger btn-sm text-white">
                                                    Tambah ulasan baru
                                                </a>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Belum ada transaksi.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
