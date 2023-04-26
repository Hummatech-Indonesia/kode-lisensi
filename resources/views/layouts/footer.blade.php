<div class="container-fluid-lg">
    <div class="main-footer section-b-space section-t-space">
        <div class="row g-md-4 g-3">
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="footer-logo">
                    <div class="theme-logo">
                        <a href="{{ route('home.index') }}" class="text-dark">
                            <h2>{{ $site->name }}</h2>
                        </a>
                    </div>

                    <div class="footer-logo-contain mt-5">
                        <p>{{ $site->description }}</p>
                    </div>
                </div>
            </div>

            <div class="col-xl col-lg-2 col-sm-3">
                <div class="footer-title">
                    <h4>Menu Website</h4>
                </div>

                <div class="footer-contain">
                    <ul>
                        <li>
                            <a href="{{ route('home.index') }}" class="text-content">Beranda</a>
                        </li>
                        <li>
                            <a href="{{ route('home.products.index') }}" class="text-content">Produk</a>
                        </li>
                        <li>
                            <a href="{{ route('home.about') }}" class="text-content">Tentang Kami</a>
                        </li>
                        <li>
                            <a href="{{ route('home.articles.index') }}" class="text-content">Artikel</a>
                        </li>
                        <li>
                            <a href="{{ route('home.contact.index') }}" class="text-content">Hubungi Kami</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                <div class="footer-title">
                    <h4>Menu Lainnya</h4>
                </div>

                <div class="footer-contain">
                    <ul>
                        <li>
                            <a href="{{ route('login') }}" class="text-content">Masuk</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="text-content">Daftar</a>
                        </li>
                        <li>
                            <a href="{{ route('home.my-cart') }}" class="text-content">Keranjang Saya</a>
                        </li>
                        <li>
                            <a href="{{ route('users.account.my-favorites') }}" class="text-content">Favorit</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-2 col-sm-3">
                <div class="footer-title">
                    <h4>Pusat Bantuan</h4>
                </div>

                <div class="footer-contain">
                    <ul>
                        <li>
                            <a href="{{ route('home.faq') }}" class="text-content">FAQ</a>
                        </li>
                        <li>
                            <a href="{{ route('home.term') }}" class="text-content">Syarat dan Ketentuan</a>
                        </li>
                        <li>
                            <a href="{{ route('home.privacy') }}" class="text-content">Kebijakan Penggunaan</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="footer-title">
                    <h4>Hubungi Kami</h4>
                </div>

                <div class="footer-contact">
                    <ul>
                        <li>
                            <div class="footer-number">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-phone">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <div class="contact-number">
                                    <h6 class="text-content">Hotline 24/7 :</h6>
                                    <h5>{{ $site->phone_number }}</h5>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="footer-number">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-mail">
                                    <path
                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <div class="contact-number">
                                    <h6 class="text-content">Email Address :</h6>
                                    <h5>{{ $site->email }}</h5>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="sub-footer section-small-space">
        <div class="reserve">
            <h6 class="text-content">{{ date('Y') }} {{ $site->name }} All rights reserved</h6>
        </div>

        <div class="social-link">
            <h6 class="text-content">Sosial Media Kami :</h6>
            <ul>
                <li>
                    <a href="{{ $site->facebook }}" target="_blank">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ $site->twitter }}" target="_blank">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ $site->instagram }}" target="_blank">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ $site->youtube }}" target="_blank">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
