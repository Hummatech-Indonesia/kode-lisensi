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

@extends('layouts.main')

@section('content')

    @include('user.breadcrumb')

    <section class="user-dashboard-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="col-sm-6 mb-3">
                        @if (session('success'))
                            <x-alert-success></x-alert-success>
                        @elseif($errors->any())
                            <x-validation-errors :errors="$errors"></x-validation-errors>
                        @endif
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4">
                    <div class="dashboard-left-sidebar">
                        <div class="close-button d-flex d-lg-none">
                            <button class="close-sidebar">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="profile-box">
                            <div class="cover-image">
                                <img src="../assets/images/inner-page/cover-img.jpg" class="img-fluid blur-up lazyloaded"
                                    alt="">
                            </div>

                            <div class="profile-contain">
                                <div class="profile-image">
                                    <div class="position-relative">
                                        @if (UserHelper::getUserPhoto())
                                            <img src="{{ asset('storage/' . UserHelper::getUserPhoto()) }}"
                                                class="blur-up update_img lazyloaded" alt="{{ UserHelper::getUserName() }}">
                                        @else
                                            <img src="{{ asset('avatar.png') }}" class="blur-up update_img lazyloaded"
                                                alt="{{ UserHelper::getUserName() }}">
                                        @endif

                                    </div>
                                </div>

                                <div class="profile-name">
                                    <h3>{{ UserHelper::getUserName() }}</h3>
                                    <h6 class="text-content">{{ UserHelper::getUserEmail() }}</h6>
                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-dashboard-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-dashboard" type="button" role="tab"
                                    aria-controls="pills-dashboard" aria-selected="false">
                                    <i data-feather="home"></i>
                                    Dashboard
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-order-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-order" type="button" role="tab" aria-controls="pills-order"
                                    aria-selected="false">
                                    <i data-feather="shopping-bag"></i>
                                    Riwayat Transaksi
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-notification-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-notification" type="button" role="tab"
                                    aria-controls="pills-notification" aria-selected="false">
                                    <i data-feather="bell"></i>
                                    Notifikasi
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-wishlist-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-wishlist" type="button" role="tab"
                                    aria-controls="pills-wishlist" aria-selected="false">
                                    <i data-feather="heart"></i>
                                    Favorit
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button" role="tab"
                                    aria-controls="pills-profile" aria-selected="true">
                                    <i data-feather="user"></i>
                                    Profile
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-security-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-security" type="button" role="tab"
                                    aria-controls="pills-security" aria-selected="false">
                                    <i data-feather="shield"></i>
                                    Update Password
                                </button>
                            </li>


                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i data-feather="log-out"></i>
                                    Logout
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </div>

                <div class="col-xxl-9 col-lg-8">
                    <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">Show
                        Menu
                    </button>
                    <div class="dashboard-right-sidebar">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel"
                                aria-labelledby="pills-dashboard-tab">
                                <div class="dashboard-home">
                                    <div class="title">
                                        <h2>Dashboard Saya</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="dashboard-user-name">
                                        <h6 class="text-content">Halo, <b
                                                class="text-title">{{ auth()->user()->name }}</b></h6>
                                        <p class="text-content">Pada dashboard akun, anda bisa melihat dan monitoring
                                            terkait aktivitas, informasi dan transaksi terbaru dari akun anda.</p>
                                    </div>

                                    <div class="total-box">
                                        <div class="row g-sm-4 g-3">
                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="totle-contain">
                                                    <img src="{{ asset('assets/images/svg/wishlist.svg') }}"
                                                        class="img-1 blur-up lazyloaded" alt="">
                                                    <img src="{{ asset('assets/images/svg/wishlist.svg') }}"
                                                        class="blur-up lazyloaded" alt="">
                                                    <div class="totle-detail">
                                                        <h5>Total Pengeluaran</h5>
                                                        <h3>{{ CurrencyHelper::rupiahCurrency(UserSummaryHelper::sumAmountOrder()) }}
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="totle-contain">
                                                    <img src="{{ asset('assets/images/svg/pending.svg') }}"
                                                        class="img-1 blur-up lazyloaded" alt="">
                                                    <img src="{{ asset('assets/images/svg/pending.svg') }}"
                                                        class="blur-up lazyloaded" alt="">
                                                    <div class="totle-detail">
                                                        <h5>Order Berhasil</h5>
                                                        <h3>{{ UserSummaryHelper::countUserOrders('success') }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="totle-contain">
                                                    <img src="{{ asset('assets/images/svg/order.svg') }}"
                                                        class="img-1 blur-up lazyloaded" alt="">
                                                    <img src="{{ asset('assets/images/svg/order.svg') }}"
                                                        class="blur-up lazyloaded" alt="">
                                                    <div class="totle-detail">
                                                        <h5>Order Pending</h5>
                                                        <h3>{{ UserSummaryHelper::countUserOrders('pending') }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-notification" role="tabpanel"
                                aria-labelledby="pills-wishlist-tab">
                                <div class="dashboard-order">
                                    <div class="title">
                                        <h2>Notifikasi Saya</h2>
                                        <span class="title-leaf title-leaf-gray">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
                                            </svg>
                                        </span>
                                    </div>
                                    @if ($totalNotifications > 0)
                                        <div class="col-xxl-12 mb-4">
                                            <div class="col-xxl-4">
                                                <form method="POST"
                                                    action="{{ route('notification.markAsRead', $take) }}">
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

                            <div class="tab-pane fade" id="pills-wishlist" role="tabpanel"
                                aria-labelledby="pills-wishlist-tab">
                                <div class="dashboard-wishlist">
                                    <div class="title">
                                        <h2>Produk Favorit Saya</h2>
                                        <span class="title-leaf title-leaf-gray">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="row g-sm-4 g-3">
                                        <div class="col-xxl-6 col-lg-6 col-md-4 col-sm-6">
                                            <p>Fitur masih dalam tahap pengembangan.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-order" role="tabpanel"
                                aria-labelledby="pills-order-tab">
                                <div class="dashboard-order">
                                    <div class="title">
                                        <h2>Riwayat Transaksi</h2>
                                        <span class="title-leaf title-leaf-gray">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('assets/svg/leaf.svg#leaf') }}"></use>
                                            </svg>
                                        </span>
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
                                                            class="blur-up lazyloaded"
                                                            alt="{{ $trans->detail_transaction->product->name }}">
                                                    </a>

                                                    <div class="order-wrap">
                                                        <a
                                                            href="{{ route('home.products.show', $trans->detail_transaction->product->slug) }}">
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
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
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

                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <div class="dashboard-profile">
                                    <div class="title">
                                        <h2>Profil Saya</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="profile-detail dashboard-bg-box">
                                        <div class="dashboard-title">
                                            <h3>{{ UserHelper::getUserName() }}</h3>
                                        </div>
                                        <div class="profile-name-detail">

                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#editProfile">Edit Profile</a>
                                        </div>

                                        <div class="location-profile">
                                            <ul>
                                                <li>
                                                    <div class="location-box">
                                                        <i data-feather="mail"></i>
                                                        <h6>{{ UserHelper::getUserEmail() }}</h6>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="location-box">
                                                        <i data-feather="check-square"></i>
                                                        <h6>Bergabung
                                                            sejak:
                                                            {{ Carbon::parse(auth()->user()->created_at)->translatedFormat('d F Y') }}
                                                        </h6>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="profile-about dashboard-bg-box">
                                        <div class="row">
                                            <div class="col-xxl-7">
                                                <div class="dashboard-title mb-3">
                                                    <h3>Detail Profil</h3>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Status :</td>
                                                                <td>{{ UserHelper::getUserRole() }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Nomor Telepon :</td>
                                                                <td>{{ UserHelper::getUserPhone() }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-xxl-5">
                                                <div class="profile-image">
                                                    <img src="{{ asset('assets/images/inner-page/dashboard-profile.png') }}"
                                                        class="img-fluid blur-up lazyloaded" alt="">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-security" role="tabpanel"
                                aria-labelledby="pills-security-tab">
                                <div class="dashboard-privacy">
                                    <div class="dashboard-bg-box mt-4">
                                        <div class="dashboard-title mb-4">
                                            <h3>Update Password</h3>
                                        </div>

                                        <form action="{{ route('user.change-password.update', auth()->id()) }}"
                                            class="theme-form theme-form-2 mega-form" method="POST"
                                            enctype="multipart/form-data">
                                            @method('PATCH')
                                            @csrf
                                            <div class="row">
                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-2 mb-0">Password Lama</label>
                                                    <div class="col-sm-10">
                                                        <input name="old_password" autocomplete="off"
                                                            class="form-control" type="password">
                                                    </div>
                                                </div>

                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-2 mb-0">Password Baru</label>
                                                    <div class="col-sm-10">
                                                        <input name="password" autocomplete="off" class="form-control"
                                                            type="password">
                                                    </div>
                                                </div>

                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-2 mb-0">Konfirmasi
                                                        Password</label>
                                                    <div class="col-sm-10">
                                                        <input name="password_confirmation" autocomplete="off"
                                                            class="form-control" type="password">
                                                    </div>
                                                </div>

                                                <div class="mb-4 row align-items-center">
                                                    <label class="col-sm-2 col-form-label form-label-title"></label>
                                                    <div class="col-sm-10">
                                                        <button type="submit"
                                                            class="btn theme-bg-color btn-md fw-bold mt-4 text-white">
                                                            Perbarui Password
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-edit-profile-modal></x-edit-profile-modal>
@endsection
