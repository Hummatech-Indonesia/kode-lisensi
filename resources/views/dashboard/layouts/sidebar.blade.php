<ul class="sidebar-links" id="simple-bar">
    @role('admin')

    <li class="back-btn"></li>

    <li class="sidebar-list">
        <a class="sidebar-link sidebar-title link-nav {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
           href="{{ route('dashboard.index') }}">
            <i class="ri-home-line"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-list">
        <a class="sidebar-link sidebar-title link-nav {{ request()->routeIs('categories.*') ? 'active' : '' }}"
           href="{{ route('categories.index') }}">
            <i class="ri-list-check-2"></i>
            <span>Kategori</span>
        </a>
    </li>

    <li class="sidebar-list">
        <a class="sidebar-link sidebar-title {{ request()->routeIs('products.*') || request()->routeIs('preorder-products.*') || request()->routeIs('archive-products.index') ? 'active' : '' }}"
           href="javascript:void(0)">
            <i class="ri-store-3-line"></i>
            <span>Produk</span>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="{{ route('products.create') }}">Tambah Produk Baru</a>
            </li>
            <li>
                <a href="{{ route('products.index') }}">Produk Stok</a>
            </li>
            <li>
                <a href="{{ route('preorder-products.index') }}">Produk Preorder</a>
            </li>
            <li>
                <a href="{{ route('archive-products.index') }}">Arsip Produk</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-list">
        <a class="sidebar-link sidebar-title" href="javascript:void(0)">
            <i class="ri-archive-line"></i>
            <span>Pesanan</span>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="{{ route('orders.index') }}">Preorder</a>
            </li>
            <li>
                <a href="{{ route('orders.history') }}">Riwayat Transaksi</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-list">
        <a class="sidebar-link sidebar-title link-nav" href="">
            <i class="ri-article-line"></i>
            <span>Artikel</span>
        </a>
    </li>

    <li class="sidebar-list">
        <a class="sidebar-link sidebar-title {{ request()->routeIs('customer.index') || request()->routeIs('reseller.index') ? 'active' : '' }}"
           href="javascript:void(0)">
            <i class="ri-user-3-line"></i>
            <span>Pengguna</span>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="{{ route('customer.index') }}">Pelanggan</a>
            </li>
            <li>
                <a href="{{ route('reseller.index') }}">Reseller</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-list">
        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
            <i class="ri-settings-line"></i>
            <span>Konfigurasi</span>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="{{ route('site-setting.index') }}">Pengaturan Website</a>
                <a href="{{ route('about-us.index') }}">Tentang Kami</a>
                <a href="{{ route('contact-us.index') }}">Kontak Kami</a>
                <a href="{{ route('faqs.index') }}">FAQ</a>
                <a href="{{ route('terms.index') }}">Terms and Policy</a>
            </li>
        </ul>
    </li>
    @endrole
</ul>

