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
    <div class="container-fluid">
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
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-3 d-flex align-items-center justify-content-center">
                                <a href="{{ route('home.products.show', $trans->detail_transaction->product->slug) }}">
                                    <img style="max-height: 200px; max-width: 200px;"
                                        src="{{ asset('storage/' . $trans->detail_transaction->product->photo) }}"
                                        class="img-fluid blur-up lazyloaded"
                                        alt="{{ $trans->detail_transaction->product->name }}">
                                </a>
                            </div>
                            <div class="col-md-9">
                                <div class="order-detail d-flex justify-content-between">
                                    <h4 class="mb-3"> {{ $trans->invoice_id }}
                                    </h4>
                                    <h4 class="mb-3">

                                        @if (
                                            $trans->invoice_status == InvoiceStatusEnum::FAILED->value ||
                                                $trans->invoice_status == InvoiceStatusEnum::EXPIRED->value)
                                            <span class="badge bg-danger">Dibatalkan</span>
                                        @elseif(
                                            $trans->invoice_status == InvoiceStatusEnum::PAID->value ||
                                                $trans->invoice_status == InvoiceStatusEnum::SETTLED->value)
                                            <span class="badge bg-primary">Lunas</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a
                                            href="{{ route('home.products.show', $trans->detail_transaction->product->slug) }}">
                                            {{ $trans->detail_transaction->product->name }}
                                        </a>
                                    </h4>
                                    <p>{{ $trans->detail_transaction->product->short_description }}</p>
                                    <ul class="list-unstyled">
                                        <li>
                                            <strong>Harga:</strong>
                                            {{ CurrencyHelper::rupiahCurrency($trans->amount) }}
                                            @if ($trans->detail_transaction->varianProduct)
                                                <span>({{ $trans->detail_transaction->varianProduct->name }})</span>
                                            @endif
                                        </li>
                                        <li>
                                            <div class="d-flex">

                                                <strong>Rate:</strong>
                                                <ul class="rating ms-2 me-2">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <li>
                                                            @if ($i <= RatingHelper::sumProductRatings($trans->detail_transaction->product->id)['stars'])
                                                                <i class="ri-star-fill"></i>
                                                            @else
                                                                <i class="ri-star-line"></i>
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

                                        </li>
                                        <li>
                                            <strong>Jenis Produk:</strong>
                                            @if ($trans->detail_transaction->product->status === ProductStatusEnum::AVAILABLE->value)
                                                <span class="">Tersedia</span>
                                            @else
                                                <span class="">Preorder</span>
                                            @endif
                                        </li>
                                    </ul>
                                    @if (RatingHelper::checkUserHasRating($trans->detail_transaction->product->id))
                                        <a href="{{ route('home.products.show', $trans->detail_transaction->product->slug) }}"
                                            class="btn btn-success btn-sm text-white mt-3">
                                            Cek Ulasan Saya
                                        </a>
                                    @else
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('home.products.show', $trans->detail_transaction->product->slug) }}"
                                                class="btn btn-primary btn-sm text-white mt-3">
                                                Tambah ulasan baru
                                            </a>
                                            @if ($trans->refund)
                                                @if ($trans->refund->status == 'accepted')
                                                    <a class="btn-primary btn-sm text-white mt-3">
                                                        Pengajuan Pengembalian Diterima
                                                    </a>
                                                @else
                                                    <a class="btn-warning btn-sm text-white mt-3">
                                                        Proses Mengajukan Pengembalian
                                                    </a>
                                                @endif
                                            @else
                                                <a id="return" data-id="{{ $trans->id }}"
                                                    class="btn btn-primary btn-sm text-white mt-3">
                                                    Ajukan Pengembalian
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
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
    <x-add-refund-modal></x-add-refund-modal>

    <script>
        $(document).on('click', '#return', function() {
            $('#addRefundModal').modal('show')
            const id = $(this).attr('data-id');
            console.log(id);
            let url = `{{ route('dashboard.refund.store', ':id') }}`.replace(':id', id);
            $('#addRefund').attr('action', url);
        });
    </script>
@endsection
