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
    <div class="" aria-labelledby="pills-wishlist-tab">
        <div class="dashboard-order">
            <div class="title">
                <h2>Notifikasi Saya</h2>
                
            </div>
            @if ($totalNotifications > 0)
                <div class="col-xxl-12 mb-4">
                    <div class="col-xxl-4">
                        <form method="POST" action="{{ route('notification.markAsRead', $take) }}">
                            @csrf
                            <button class="btn theme-bg-color btn-md fw-bold mt-4 text-white">
                                Tandai
                                Semua Telah Dibaca
                            </button>
                        </form>

                    </div>
                </div>
            @endif

            <div class="order-contain">
                @forelse($notifications as $notify)
                    <div class="order-box dashboard-bg-box">
                        <div class="order-container">
                            <div class="order-icon">
                                <i data-feather="help-circle"></i>
                            </div>

                            <div class="order-detail">
                                <h4>{{ $notify->data['name'] }} </h4>
                                <h6 class="text-content">
                                    {{ Carbon::parse($notify->created_at)->translatedFormat('d F Y h:i') }}
                                </h6>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Belum ada notifikasi terbaru.</p>
                @endforelse

            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
