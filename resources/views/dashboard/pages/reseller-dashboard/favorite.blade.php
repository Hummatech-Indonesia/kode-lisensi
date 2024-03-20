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
        <div class="dashboard-wishlist">
            <div class="title">
                <h2>Produk Favorit Saya</h2>
                
            </div>
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-6 col-lg-6 col-md-4 col-sm-6">
                    <p>Fitur masih dalam tahap pengembangan.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
