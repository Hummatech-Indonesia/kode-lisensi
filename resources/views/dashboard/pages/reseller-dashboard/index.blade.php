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
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Halo, <b>{{ auth()->user()->name }}</b></h5>
                        <p class="card-text">Pada dashboard akun, anda bisa melihat dan monitoring terkait aktivitas,
                            informasi dan transaksi terbaru dari akun anda.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-xxl-4 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total Pengeluaran</span>
                                <h4 class="mb-0 counter">{{ CurrencyHelper::rupiahCurrency(UserSummaryHelper::sumAmountOrder()) }}
                                </h4>
                            </div>
                            <div class="align-self-center text-center">
                                <i class="ri-exchange-dollar-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-4 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Order Berhasil</span>
                                <h4 class="mb-0 counter">{{ UserSummaryHelper::countUserOrders('success') }}
                                </h4>
                            </div>
                            <div class="align-self-center text-center">
                                <i class="ri-shopping-bag-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-4 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Order Pending</span>
                                <h4 class="mb-0 counter">{{ UserSummaryHelper::countUserOrders('pending') }}
                                </h4>
                            </div>
                            <div class="align-self-center text-center">
                                <i class="ri-time-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
