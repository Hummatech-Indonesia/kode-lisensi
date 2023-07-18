@php use App\Helpers\UserHelper;
    use App\Helpers\NotificationHelper;use Carbon\Carbon;
    $take = 5;
    $notifications = NotificationHelper::take($take);
    $totalNotifications = NotificationHelper::count();
@endphp
    <!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    @include('dashboard.layouts.header')
    @yield('css')
</head>

<body>
<!-- tap on top start -->
<div class="tap-top">
    <span class="lnr lnr-chevron-up"></span>
</div>
<!-- tap on tap end -->

<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    <div class="page-header">
        <div class="header-wrapper m-0">
            <div class="header-logo-wrapper p-0">
                <div class="logo-wrapper">
                    <a href="{{ route('home.index') }}">
                        <img class="img-fluid main-logo" src="assets/images/logo/1.png" alt="logo">
                        <img class="img-fluid white-logo" src="assets/images/logo/1-white.png" alt="logo">
                    </a>
                </div>
                <div class="toggle-sidebar">
                    <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
                    <a href="{{ route('home.index') }}">
                        <img src="assets/images/logo/1.png" class="img-fluid" alt="">
                    </a>
                </div>
            </div>

            <h3>
                <span class="badge badge-success">Login Sebagai : {{ UserHelper::getUserRole() }}</span>
            </h3>
            <div class="nav-right col-6 pull-right right-header p-0">
                <ul class="nav-menus">
                    <li class="onhover-dropdown">
                        <div class="notification-box">
                            <i class="ri-notification-line"></i>
                            @if($totalNotifications > 0)
                                <span class="badge rounded-pill badge-theme">{{ $totalNotifications }}</span>
                            @endif

                        </div>
                        <ul class="notification-dropdown onhover-show-div"
                            style="display: block; overflow-y: scroll; max-height: 300px">
                            <li>
                                <i class="ri-notification-line"></i>
                                <h6 class="f-18 mb-0">Notifikasi</h6>
                            </li>
                            @forelse($notifications as $notify)
                                <li>
                                    <p>
                                        <i class="fa fa-circle me-2 font-primary"></i>{{ $notify->data['name'] }} <span
                                            class="pull-right">{{ Carbon::parse($notify->created_at)->diffForHumans() }}</span>
                                    </p>
                                </li>
                            @empty
                                <li>
                                    <p>
                                        <i class="fa fa-circle me-2 font-primary"></i>Belum ada notifikasi.
                                    </p>
                                </li>
                            @endforelse
                            @if($totalNotifications > 0)
                                <li>
                                    <form method="POST" action="{{ route('notification.markAsRead', $take) }}">
                                        @csrf
                                        <button class="btn btn-primary mt-4"
                                                onclick="return confirm('Yakin ingin tandai telah dibaca?')">Tandai
                                            semua telah dibaca
                                        </button>
                                    </form>
                                </li>
                            @endif

                        </ul>
                    </li>
                    <li class="profile-nav onhover-dropdown pe-0 me-0">
                        <div class="media profile-media">
                            @if(UserHelper::getUserPhoto())
                                <img class="user-profile rounded-circle"
                                     src="{{ asset('storage/' . UserHelper::getUserPhoto()) }}"
                                     alt="{{ UserHelper::getUserName() }}">
                            @else
                                <img class="user-profile rounded-circle" src="{{ asset('avatar.png') }}"
                                     alt="{{ UserHelper::getUserName() }}">
                            @endif

                            <div class="user-name-hide media-body">
                                <span>{{ UserHelper::getUserName() }}</span>
                                <p class="mb-0 font-roboto">{{ UserHelper::getUserRole() }}<i
                                        class="middle ri-arrow-down-s-line"></i></p>
                            </div>
                        </div>
                        <ul class="profile-dropdown onhover-show-div">
                            <li>
                                <a href="{{ route('user.profile.index') }}">
                                    <i data-feather="user"></i>
                                    <span>Pengaturan Akun</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.change-password.index') }}">
                                    <i data-feather="settings"></i>
                                    <span>Ubah Password</span>
                                </a>
                            </li>
                            <li>
                                <a data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                   href="javascript:void(0)">
                                    <i data-feather="log-out"></i>
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Header Ends-->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper">
            <div id="sidebarEffect"></div>
            <div>
                @include('dashboard.layouts.navbar')
            </div>
        </div>
        <!-- Page Sidebar Ends-->

        <!-- index body start -->
        <div class="page-body">
            <div class="container-fluid">
                <div class="row">
                    @yield('content')
                </div>

            </div>
            <!-- Container-fluid Ends-->

            <!-- footer start-->
            <div class="container-fluid">
                <footer class="footer">
                    <div class="row">
                        <div class="col-md-12 footer-copyright text-center">
                            <p class="mb-0">Copyright {{ date('Y') }} © {{ config('app.name') }} All Rights Reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- footer End-->
        </div>
        <!-- index body end -->

    </div>
    <!-- Page Body End -->
</div>
<!-- page-wrapper End-->

<!-- Modal Start -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <h5 class="modal-title" id="staticBackdropLabel">Logout?</h5>
                    <p>Apa anda yakin ingin logout?</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="button-box">
                        <button type="button" class="btn btn--no" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn--yes btn-primary">Logout</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal End -->

@include('dashboard.layouts.footer')
@yield('script')
</body>
</html>
