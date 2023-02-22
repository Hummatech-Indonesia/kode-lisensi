<ul class="sidebar-links" id="simple-bar">
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
        <a class="sidebar-link sidebar-title" href="javascript:void(0)">
            <i class="ri-archive-line"></i>
            <span>Orders</span>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="order-list.html">Order List</a>
            </li>
            <li>
                <a href="order-detail.html">Order Detail</a>
            </li>
            <li>
                <a href="order-tracking.html">Order Tracking</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-list">
        <a class="sidebar-link sidebar-title link-nav" href="product-review.html">
            <i class="ri-star-line"></i>
            <span>Product Review</span>
        </a>
    </li>

    <li class="sidebar-list">
        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
            <i class="ri-settings-line"></i>
            <span>Settings</span>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="profile-setting.html">Profile Setting</a>
            </li>
        </ul>
    </li>
</ul>
