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
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xxl-4 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Jumlah Artikel</span>
                                <h4 class="mb-0 counter">
                                    {{ CurrencyHelper::rupiahCurrency(UserSummaryHelper::sumAmountOrder()) }}
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
                                <span class="m-0">Jumlah pengunjung</span>
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
                                <span class="m-0">Jumlah Kategori</span>
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
            <h3 class="mb-3">Top 5 Artikel dengan kunjungan terbanyak</h3>
            <div class="table-responsive">
                <table class="table variation-table rounded">
                    <thead class="bg-primary">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Artikel</th>
                            <th scope="col">Jumlah pengunjung</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr>
                            <td>1</td>
                            <td>Hukum penggunaan software bajakan</td>
                            <td>1000</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Cyber Security</td>
                            <td>750</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Customer Service</td>
                            <td>500</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
@section('script')
@endsection
