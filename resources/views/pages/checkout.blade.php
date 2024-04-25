@php
    use App\Enums\ProductStatusEnum;
    use App\Enums\ProductTypeEnum;
    use App\Enums\UserRoleEnum;
    use App\Helpers\CurrencyHelper;
    use App\Helpers\UserHelper;
@endphp
@extends('layouts.main')
@section('captcha')
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function rupiahCurrency(number) {
                return "Rp " + number.toLocaleString('id-ID');
            }

            function calculatePriceAfterDiscount(price, discount, formatted, discount_price) {
                if (discount_price == 1) {
                    var total = price - discount;
                } else {
                    var discountPercentage = parseFloat(discount) / 100;
                    var total = price - (price * discountPercentage);
                }
                if (formatted) {
                    return rupiahCurrency(total);
                }
                return total;
            }

            function countPriceAfterTax(price, tax) {
                var total = price + (price * (tax / 100));
                return rupiahCurrency(total);
            }

            $('input[name="role"]').change(function() {
                var discount = $(this).data('discount');
                var sell_price = $(this).data('sell-price');
                var discount_price = $(this).data('discount-price');
                var pure_discount = $(this).data('pure-discount');
                console.log(discount);
                console.log(sell_price);
                console.log(discount_price);

                var subtotal = calculatePriceAfterDiscount(sell_price, discount, false,
                    discount_price);
                var subtotal_show = rupiahCurrency(subtotal);
                var total = countPriceAfterTax(subtotal, 10)
                if (discount_price == 1) {
                    $('#discount_whatsapp').text(rupiahCurrency(discount));
                } else {

                    $('#discount_whatsapp').text(discount + '%');
                }
                $('#subtotal_whatsapp').text(subtotal_show);
                $('#total_whatsapp').text(total);
            });
        });
    </script>
@endsection
@section('content')
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Checkout {{ $product->name }}</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home.index') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (UserHelper::getUserRole() === UserRoleEnum::ADMINISTRATOR->value)
        <section class="checkout-section-2 section-b-space">
            <form method="POST" action="{{ route('transaction.whatsapp.checkout', [$product->slug, $varian]) }}">
                @csrf
                <div class="container-fluid-lg">
                    <div class="row g-sm-4 g-3">
                        <div class="col-lg-8">
                            @if (ProductStatusEnum::PREORDER->value === $product->status && !session('success'))
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    <div class="alert-message">
                                        <strong>Perlu diingat!</strong><br> Produk preorder akan diproses
                                        secara manual
                                        oleh
                                        admin dengan waktu maksimal 2 hari.
                                    </div>
                                </div>
                            @endif
                            <div class="left-sidebar-checkout">
                                <div class="checkout-detail-box">
                                    <ul>
                                        <li>
                                            <div class="checkout-icon">
                                                <lord-icon target=".nav-item" src="https://cdn.lordicon.com/ggihhudh.json"
                                                    trigger="loop-on-hover"
                                                    colors="primary:#121331,secondary:#646e78,tertiary:#0baf9a"
                                                    class="lord-icon">
                                                </lord-icon>
                                            </div>
                                            <div class="checkout-box">
                                                <div class="checkout-title">
                                                    <h4>Silahkan lengkapi form dibawah ini untuk
                                                        melanjutkan ke pembayaran</h4>
                                                </div>

                                                <div class="checkout-detail">
                                                    <div class="right-sidebar-box">
                                                        <div class="row">
                                                            @if (session('success'))
                                                                <x-alert-success></x-alert-success>
                                                            @elseif(session('error'))
                                                                <x-alert-failed></x-alert-failed>
                                                            @endif

                                                            <div class="col-xxl-12 col-lg-12 col-sm-12">
                                                                <div class="mb-md-4 mb-3 custom-form">
                                                                    <label for="exampleFormControlInput"
                                                                        class="form-label">Nama
                                                                        Lengkap</label>
                                                                    <div class="custom-input">
                                                                        <input autofocus value="{{ auth()->user()->name }}"
                                                                            type="text" name="name"
                                                                            class="form-control @error('name') is-invalid @enderror"
                                                                            autocomplete="off" placeholder="John Doe">
                                                                        @error('name')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-xxl-12 col-lg-12 col-sm-12">
                                                                <div class="mb-md-4 mb-3 custom-form">
                                                                    <label for="exampleFormControlInput2"
                                                                        class="form-label">Email</label>
                                                                    <div class="custom-input">
                                                                        <input autocomplete="off" type="email"
                                                                            class="form-control @error('email') is-invalid @enderror"
                                                                            value="{{ auth()->user()->email }}"
                                                                            name="email" placeholder="johndoe@gmail.com">
                                                                        @error('email')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-xxl-12 col-lg-12 col-sm-12">
                                                                <div class="mb-md-4 mb-3 custom-form">
                                                                    <label for="exampleFormControlInput3"
                                                                        class="form-label">Nomor telepon</label>
                                                                    <div class="custom-input">
                                                                        <input autocomplete="off"
                                                                            value="{{ old('phone_number', auth()->user()->phone_number) }}"
                                                                            name="phone_number" type="number"
                                                                            class="form-control @error('phone_number') is-invalid @enderror"
                                                                            id="exampleFormControlInput3"
                                                                            placeholder="0812648321">
                                                                        @error('phone_number')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-xxl-12 col-lg-12 col-sm-12">
                                                                <div class="mb-md-4 mb-3 custom-form">
                                                                    <label for="exampleFormControlInput3"
                                                                        class="form-label">Role Pembeli</label>
                                                                    <div class="custom-input">
                                                                        @if ($varian)
                                                                            <div class="d-flex gap-2">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input"
                                                                                        type="radio" name="role"
                                                                                        data-discount="{{ $product->discount }}"
                                                                                        data-pure-discount="{{ $product->discount }}"
                                                                                        data-sell-price="{{ $product->varianProducts[0]->sell_price }}"
                                                                                        data-discount-price="{{ $product->discount_price }}"
                                                                                        id="role" value="customer">
                                                                                    <label class="form-check-label"
                                                                                        for="role">
                                                                                        Customer
                                                                                    </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input"
                                                                                        type="radio" name="role"
                                                                                        data-discount="{{ $product->reseller_discount }}"
                                                                                        data-pure-discount="{{ $product->reseller_discount }}"
                                                                                        data-sell-price="{{ $product->varianProducts[0]->sell_price }}"
                                                                                        data-discount-price="{{ $product->discount_price }}"
                                                                                        id="role" value="reseller">
                                                                                    <label class="form-check-label"
                                                                                        for="role">
                                                                                        Reseller
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <div class="d-flex gap-2">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input"
                                                                                        type="radio" name="role"
                                                                                        data-discount="{{ $product->discount }}"
                                                                                        data-pure-discount="{{ $product->discount }}"
                                                                                        data-sell-price="{{ $product->sell_price }}"
                                                                                        data-discount-price="{{ $product->discount_price }}"
                                                                                        id="role" value="customer">
                                                                                    <label class="form-check-label"
                                                                                        for="role">
                                                                                        Customer
                                                                                    </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input"
                                                                                        type="radio" name="role"
                                                                                        data-discount="{{ $product->reseller_discount }}"
                                                                                        data-pure-discount="{{ $product->reseller_discount }}"
                                                                                        data-sell-price="{{ $product->sell_price }}"
                                                                                        data-discount-price="{{ $product->discount_price }}"
                                                                                        id="role" value="reseller">
                                                                                    <label class="form-check-label"
                                                                                        for="role">
                                                                                        Reseller
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        @error('role')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xxl-12 col-lg-12 col-sm-12">
                                                                <label for="" class="form-label">Tambahkan
                                                                    Lisensi</label>
                                                                <div class=""
                                                                    style="border: 1px solid rgb(55, 55, 55); padding:1rem; border-radius:0.5rem; background-color:rgb(199, 199, 199)">
                                                                    @if ($product->type == ProductTypeEnum::SERIAL->value)
                                                                        <input type="text" name="serial_key"
                                                                            class="form-control" id="serial_key">
                                                                    @elseif ($product->type == ProductTypeEnum::CREDENTIAL->value)
                                                                        <label for="username" class="form-label">Username
                                                                        </label>
                                                                        <div class="custom-input">
                                                                            <input type="text" name="username"
                                                                                class="form-control" id="">
                                                                            <label for="password"
                                                                                class="form-label">Password</label>
                                                                            <input type="password" name="password"
                                                                                class="form-control" id="">
                                                                        </div>
                                                                    @else
                                                                        <div class="custom-input">
                                                                            <textarea name="description" id="" cols="15" rows="5"
                                                                                class="form-control @error('description') is-invalid @enderror" placeholder="catatan pemesanan">{{ old('description') }}</textarea>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-12 fv-row mb-10">
                                                                {!! htmlFormSnippet() !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkout-icon">
                                                <lord-icon target=".nav-item" src="https://cdn.lordicon.com/ggihhudh.json"
                                                    trigger="loop-on-hover"
                                                    colors="primary:#121331,secondary:#646e78,tertiary:#0baf9a"
                                                    class="lord-icon">
                                                </lord-icon>
                                            </div>
                                            <div class="checkout-box">
                                                <div class="checkout-title">
                                                    <h4>Pilih Metode Pembayaran</h4>
                                                </div>
                                                <div class="checkout-detail">
                                                    <div class="accordion accordion-flush custom-accordion"
                                                        id="accordionFlushExample">
                                                        <div class="accordion-item">
                                                            <div class="accordion-header" id="flush-headingFour">
                                                                <div class="accordion-button" data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapseFour"
                                                                    aria-expanded="true">
                                                                    <div class="custom-form-check form-check mb-0">
                                                                        <label class="form-check-label"
                                                                            for="cash"><input
                                                                                class="form-check-input mt-0"
                                                                                type="radio" name="flexRadioDefault"
                                                                                id="cash" checked=""> Virtual
                                                                            Account</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="flush-collapseFour"
                                                                class="accordion-collapse collapse show"
                                                                data-bs-parent="#accordionFlushExample" style="">
                                                                <div class="accordion-body">
                                                                    <div class="checkout-detail">
                                                                        <div class="row g-4">
                                                                            @foreach ($payment_channels['Virtual Account'] as $channels)
                                                                                <div class="col-xxl-6">
                                                                                    <div class="delivery-option">
                                                                                        <div class="delivery-category">
                                                                                            <div
                                                                                                class="shipment-detail text-center">
                                                                                                <img class="img-fluid"
                                                                                                    width="120px"
                                                                                                    src="{{ $channels['icon_url'] }}"
                                                                                                    alt="{{ $channels['name'] }}">
                                                                                                <div
                                                                                                    class="form-check custom-form-check hide-check-box mt-3">
                                                                                                    <input
                                                                                                        class="form-check-input"
                                                                                                        type="radio"
                                                                                                        name="payment_method"
                                                                                                        id="standard"
                                                                                                        value="{{ $channels['code'] }}">
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="standard">{{ $channels['name'] }}</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordion-item">
                                                            <div class="accordion-header" id="flush-headingOne">
                                                                <div class="accordion-button collapsed"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapseOne"
                                                                    aria-expanded="false">
                                                                    <div class="custom-form-check form-check mb-0">
                                                                        <label class="form-check-label"
                                                                            for="credit"><input
                                                                                class="form-check-input mt-0"
                                                                                type="radio" name="flexRadioDefault"
                                                                                id="credit">
                                                                            E-wallet</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="flush-collapseOne"
                                                                class="accordion-collapse collapse"
                                                                data-bs-parent="#accordionFlushExample">
                                                                <div class="accordion-body">
                                                                    <div class="checkout-detail">
                                                                        <div class="row g-4">
                                                                            @foreach ($payment_channels['E-Wallet'] as $channels)
                                                                                <div class="col-xxl-6">
                                                                                    <div class="delivery-option">
                                                                                        <div class="delivery-category">
                                                                                            <div
                                                                                                class="shipment-detail text-center">
                                                                                                <img class="img-fluid"
                                                                                                    width="120px"
                                                                                                    src="{{ $channels['icon_url'] }}"
                                                                                                    alt="{{ $channels['name'] }}">
                                                                                                <div
                                                                                                    class="form-check custom-form-check hide-check-box mt-3">
                                                                                                    <input
                                                                                                        class="form-check-input"
                                                                                                        type="radio"
                                                                                                        name="payment_method"
                                                                                                        id="standard"
                                                                                                        value="{{ $channels['code'] }}">
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="standard">{{ $channels['name'] }}</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordion-item">
                                                            <div class="accordion-header" id="flush-headingTwo">
                                                                <div class="accordion-button collapsed"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapseTwo"
                                                                    aria-expanded="false">
                                                                    <div class="custom-form-check form-check mb-0">
                                                                        <label class="form-check-label"
                                                                            for="banking"><input
                                                                                class="form-check-input mt-0"
                                                                                type="radio" name="flexRadioDefault"
                                                                                id="banking">Retail
                                                                            Outlet</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="flush-collapseTwo"
                                                                class="accordion-collapse collapse"
                                                                data-bs-parent="#accordionFlushExample">
                                                                <div class="accordion-body">
                                                                    <div class="checkout-detail">
                                                                        <div class="row g-4">
                                                                            @foreach ($payment_channels['Convenience Store'] as $channels)
                                                                                <div class="col-xxl-6">
                                                                                    <div class="delivery-option">
                                                                                        <div class="delivery-category">
                                                                                            <div
                                                                                                class="shipment-detail text-center">
                                                                                                <img class="img-fluid"
                                                                                                    width="120px"
                                                                                                    src="{{ $channels['icon_url'] }}"
                                                                                                    alt="{{ $channels['name'] }}">
                                                                                                <div
                                                                                                    class="form-check custom-form-check hide-check-box mt-3">
                                                                                                    <input
                                                                                                        class="form-check-input"
                                                                                                        type="radio"
                                                                                                        name="payment_method"
                                                                                                        id="standard"
                                                                                                        value="{{ $channels['code'] }}">
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="standard">{{ $channels['name'] }}</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <div class="right-side-summery-box">
                                <div class="summery-box-2">
                                    <div class="summery-header">
                                        <h3>Produk dipesan</h3>
                                    </div>

                                    <ul class="summery-contain">
                                        <li>
                                            <div class="card">
                                                <img src="{{ asset('storage/' . $product->photo) }}"
                                                    class="img-fluid blur-up lazyloaded" alt="...">
                                            </div>
                                        </li>
                                        <li class="mt-3">
                                            <h3>{{ $product->name }} </h3>
                                        </li>
                                    </ul>
                                    @if ($varian)
                                        <ul class="summery-total">
                                            <li>
                                                <h4>Status Produk</h4>
                                                <h4 class="price">
                                                    @if (ProductStatusEnum::PREORDER->value == $product->status)
                                                        Preorder
                                                    @else
                                                        Tersedia
                                                    @endif
                                                </h4>
                                            </li>
                                            <li>
                                                <h4>Harga</h4>
                                                @if ($product->varianProducts->isEmpty())
                                                    <h4 class="price">
                                                        {{ CurrencyHelper::rupiahCurrency($product->sell_price) }}
                                                    </h4>
                                                @else
                                                    <h4 class="price">
                                                        {{ CurrencyHelper::rupiahCurrency($product->varianProducts[0]->sell_price) }}
                                                    </h4>
                                                @endif
                                            </li>
                                            <li>
                                                <h4>Discount</h4>
                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                    @if ($product->discount_price == 1)
                                                        <h4 class="price">
                                                            {{ CurrencyHelper::rupiahCurrency($product->reseller_discount) }}
                                                        </h4>
                                                    @else
                                                        <h4 class="price">
                                                            {{ $product->reseller_discount }}%</h4>
                                                    @endif
                                                @else
                                                    @if ($product->discount_price == 1)
                                                        <h4 class="price" id="discount_whatsapp">
                                                            {{ CurrencyHelper::rupiahCurrency($product->discount) }}
                                                        </h4>
                                                    @else
                                                        <h4 class="price" id="discount_whatsapp">
                                                            {{ $product->discount }}%</h4>
                                                    @endif
                                                @endif
                                            </li>
                                            <li>
                                                <h4>Subtotal</h4>
                                                @php
                                                    if ($product->varianProducts->isEmpty()) {
                                                        $discount =
                                                            UserHelper::getUserRole() == UserRoleEnum::RESELLER->value
                                                                ? $product->reseller_discount
                                                                : $product->discount;

                                                        $subtotal = CurrencyHelper::countPriceAfterDiscount(
                                                            $product->sell_price,
                                                            $discount,
                                                            false,
                                                            $product->discount_price,
                                                        );
                                                    } else {
                                                        $discount =
                                                            UserHelper::getUserRole() == UserRoleEnum::RESELLER->value
                                                                ? $product->reseller_discount
                                                                : $product->discount;

                                                        $subtotal = CurrencyHelper::countPriceAfterDiscount(
                                                            $product->varianProducts[0]->sell_price,
                                                            $discount,
                                                            false,
                                                            $product->discount_price,
                                                        );
                                                    }
                                                @endphp
                                                {{-- @if ($product->varianProducts->isEmpty()) --}}
                                                <h4 class="price" id="subtotal_whatsapp">
                                                    {{ CurrencyHelper::rupiahCurrency($subtotal) }}</h4>
                                                {{-- @else
                                            <h4 class="price">{{CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount($product->varianProducts[0]->sell_price,$product->discount))}}</h4>
                                            @endif --}}
                                            </li>

                                            <li>
                                                <h4>Pajak (PPN)</h4>
                                                <h4 class="price">10%</h4>
                                            </li>

                                            <li class="list-total">
                                                <h4>Total</h4>
                                                {{-- @if ($product->varianProducts->isEmpty()) --}}
                                                <h4 class="price" id="total_whatsapp">
                                                    {{ CurrencyHelper::countPriceAfterTax($subtotal, 10, true) }}
                                                </h4>
                                                {{-- @else
                                            <h4 class="price">{{CurrencyHelper::countPriceAfterTax($subtotal,10,true)}}</h4>
                                            @endif --}}
                                            </li>
                                        </ul>
                                    @else
                                        <ul class="summery-total">
                                            <li>
                                                <h4>Status Produk</h4>
                                                <h4 class="price">
                                                    @if (ProductStatusEnum::PREORDER->value == $product->status)
                                                        Preorder
                                                    @else
                                                        Tersedia
                                                    @endif
                                                </h4>
                                            </li>
                                            <li>
                                                <h4>Harga</h4>
                                                <h4 class="price">
                                                    {{ CurrencyHelper::rupiahCurrency($product->sell_price) }}
                                                </h4>
                                            </li>
                                            <li>
                                                <h4>Discount</h4>
                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                    @if ($product->discount_price == 1)
                                                        <h4 class="price">
                                                            {{ CurrencyHelper::rupiahCurrency($product->reseller_discount) }}
                                                        </h4>
                                                    @else
                                                        <h4 class="price">
                                                            {{ $product->reseller_discount }}%</h4>
                                                    @endif
                                                @else
                                                    @if ($product->discount_price == 1)
                                                        <h4 class="price" id="discount_whatsapp">
                                                            {{ CurrencyHelper::rupiahCurrency($product->discount) }}
                                                        </h4>
                                                    @else
                                                        <h4 class="price" id="discount_whatsapp">
                                                            {{ $product->discount }}%</h4>
                                                    @endif
                                                @endif
                                            </li>
                                            <li>
                                                <h4>Subtotal</h4>
                                                @php
                                                    $discount =
                                                        UserHelper::getUserRole() == UserRoleEnum::RESELLER->value
                                                            ? $product->reseller_discount
                                                            : $product->discount;

                                                    $subtotal = CurrencyHelper::countPriceAfterDiscount(
                                                        $product->sell_price,
                                                        $discount,
                                                        false,
                                                        $product->discount_price,
                                                    );
                                                @endphp
                                                <h4 class="price" id="subtotal_whatsapp">
                                                    {{ CurrencyHelper::rupiahCurrency($subtotal) }}</h4>
                                            </li>

                                            <li>
                                                <h4>Pajak (PPN)</h4>
                                                <h4 class="price">10%</h4>
                                            </li>

                                            <li class="list-total">
                                                <h4>Total</h4>
                                                <h4 class="price" id="total_whatsapp">
                                                    {{ CurrencyHelper::countPriceAfterTax($subtotal, 10, true) }}
                                                </h4>
                                            </li>
                                        </ul>
                                    @endif

                                </div>

                                @if ($product->status === ProductStatusEnum::AVAILABLE->value)
                                    @if ($product->licenses)
                                        <button type="submit"
                                            class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold">Beli Produk
                                        </button>
                                    @else
                                        <button class="btn btn-md bg-danger cart-button text-white w-100">Stok produk
                                            telah habis
                                        </button>
                                    @endif
                                @else
                                    <button type="submit"
                                        class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold">Beli Produk
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    @else
        <section class="checkout-section-2 section-b-space">
            <form method="POST" action="{{ route('doCheckout', [$product->slug, $varian]) }}">
                @csrf
                <div class="container-fluid-lg">
                    <div class="row g-sm-4 g-3">
                        <div class="col-lg-8">
                            @if (ProductStatusEnum::PREORDER->value === $product->status && !session('success'))
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    <div class="alert-message">
                                        <strong>Perlu diingat!</strong><br> Produk preorder akan diproses secara manual
                                        oleh
                                        admin dengan waktu maksimal 2 hari.
                                    </div>
                                </div>
                            @endif

                            <div class="left-sidebar-checkout">
                                <div class="checkout-detail-box">
                                    <ul>
                                        <li>
                                            <div class="checkout-icon">
                                                <lord-icon target=".nav-item" src="https://cdn.lordicon.com/ggihhudh.json"
                                                    trigger="loop-on-hover"
                                                    colors="primary:#121331,secondary:#646e78,tertiary:#0baf9a"
                                                    class="lord-icon">
                                                </lord-icon>
                                            </div>
                                            <div class="checkout-box">
                                                <div class="checkout-title">
                                                    <h4>Silahkan lengkapi form dibawah ini untuk
                                                        melanjutkan ke pembayaran</h4>
                                                </div>

                                                <div class="checkout-detail">
                                                    <div class="right-sidebar-box">
                                                        <div class="row">
                                                            @if (session('success'))
                                                                <x-alert-success></x-alert-success>
                                                            @elseif(session('error'))
                                                                <x-alert-failed></x-alert-failed>
                                                            @endif

                                                            <div class="col-xxl-12 col-lg-12 col-sm-12">
                                                                <div class="mb-md-4 mb-3 custom-form">
                                                                    <label for="exampleFormControlInput"
                                                                        class="form-label">Nama
                                                                        Lengkap</label>
                                                                    <div class="custom-input">
                                                                        <input autofocus
                                                                            value="{{ auth()->user()->name }}"
                                                                            type="text" name="name"
                                                                            class="form-control @error('name') is-invalid @enderror"
                                                                            autocomplete="off" placeholder="John Doe">
                                                                        @error('name')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-xxl-12 col-lg-12 col-sm-12">
                                                                <div class="mb-md-4 mb-3 custom-form">
                                                                    <label for="exampleFormControlInput2"
                                                                        class="form-label">Email</label>
                                                                    <div class="custom-input">
                                                                        <input autocomplete="off" type="email"
                                                                            class="form-control @error('email') is-invalid @enderror"
                                                                            value="{{ auth()->user()->email }}"
                                                                            name="email"
                                                                            placeholder="johndoe@gmail.com">
                                                                        @error('email')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-xxl-12 col-lg-12 col-sm-12">
                                                                <div class="mb-md-4 mb-3 custom-form">
                                                                    <label for="exampleFormControlInput3"
                                                                        class="form-label">Nomor telepon</label>
                                                                    <div class="custom-input">
                                                                        <input autocomplete="off"
                                                                            value="{{ old('phone_number', auth()->user()->phone_number) }}"
                                                                            name="phone_number" type="number"
                                                                            class="form-control @error('phone_number') is-invalid @enderror"
                                                                            id="exampleFormControlInput3"
                                                                            placeholder="0812648321">
                                                                        @error('phone_number')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-xxl-12 col-lg-12 col-sm-12">
                                                                <div class="mb-md-4 mb-3 custom-form">
                                                                    <label for="exampleFormControlInput4"
                                                                        class="form-label">Catatan (opsional)</label>
                                                                    <div class="custom-input">
                                                                        <textarea name="note" id="exampleFormControlInput4" cols="15" rows="5"
                                                                            class="form-control @error('note') is-invalid @enderror" placeholder="catatan pemesanan">{{ old('note') }}</textarea>
                                                                        @error('note')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 fv-row mb-10">
                                                                {!! htmlFormSnippet() !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkout-icon">
                                                <lord-icon target=".nav-item" src="https://cdn.lordicon.com/ggihhudh.json"
                                                    trigger="loop-on-hover"
                                                    colors="primary:#121331,secondary:#646e78,tertiary:#0baf9a"
                                                    class="lord-icon">
                                                </lord-icon>
                                            </div>
                                            <div class="checkout-box">
                                                <div class="checkout-title">
                                                    <h4>Pilih Metode Pembayaran</h4>
                                                </div>

                                                <div class="checkout-detail">
                                                    <div class="accordion accordion-flush custom-accordion"
                                                        id="accordionFlushExample">
                                                        <div class="accordion-item">
                                                            <div class="accordion-header" id="flush-headingFour">
                                                                <div class="accordion-button" data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapseFour"
                                                                    aria-expanded="true">
                                                                    <div class="custom-form-check form-check mb-0">
                                                                        <label class="form-check-label"
                                                                            for="cash"><input
                                                                                class="form-check-input mt-0"
                                                                                type="radio" name="flexRadioDefault"
                                                                                id="cash" checked=""> Virtual
                                                                            Account</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="flush-collapseFour"
                                                                class="accordion-collapse collapse show"
                                                                data-bs-parent="#accordionFlushExample" style="">
                                                                <div class="accordion-body">
                                                                    <div class="checkout-detail">
                                                                        <div class="row g-4">
                                                                            @foreach ($payment_channels['Virtual Account'] as $channels)
                                                                                <div class="col-xxl-6">
                                                                                    <div class="delivery-option">
                                                                                        <div class="delivery-category">
                                                                                            <div
                                                                                                class="shipment-detail text-center">
                                                                                                <img class="img-fluid"
                                                                                                    width="120px"
                                                                                                    src="{{ $channels['icon_url'] }}"
                                                                                                    alt="{{ $channels['name'] }}">
                                                                                                <div
                                                                                                    class="form-check custom-form-check hide-check-box mt-3">
                                                                                                    <input
                                                                                                        class="form-check-input"
                                                                                                        type="radio"
                                                                                                        name="payment_code"
                                                                                                        id="standard"
                                                                                                        value="{{ $channels['code'] }}">
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="standard">{{ $channels['name'] }}</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordion-item">
                                                            <div class="accordion-header" id="flush-headingOne">
                                                                <div class="accordion-button collapsed"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapseOne"
                                                                    aria-expanded="false">
                                                                    <div class="custom-form-check form-check mb-0">
                                                                        <label class="form-check-label"
                                                                            for="credit"><input
                                                                                class="form-check-input mt-0"
                                                                                type="radio" name="flexRadioDefault"
                                                                                id="credit">
                                                                            E-wallet</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="flush-collapseOne"
                                                                class="accordion-collapse collapse"
                                                                data-bs-parent="#accordionFlushExample">
                                                                <div class="accordion-body">
                                                                    <div class="checkout-detail">
                                                                        <div class="row g-4">
                                                                            @foreach ($payment_channels['E-Wallet'] as $channels)
                                                                                <div class="col-xxl-6">
                                                                                    <div class="delivery-option">
                                                                                        <div class="delivery-category">
                                                                                            <div
                                                                                                class="shipment-detail text-center">
                                                                                                <img class="img-fluid"
                                                                                                    width="120px"
                                                                                                    src="{{ $channels['icon_url'] }}"
                                                                                                    alt="{{ $channels['name'] }}">
                                                                                                <div
                                                                                                    class="form-check custom-form-check hide-check-box mt-3">
                                                                                                    <input
                                                                                                        class="form-check-input"
                                                                                                        type="radio"
                                                                                                        name="payment_code"
                                                                                                        id="standard"
                                                                                                        value="{{ $channels['code'] }}">
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="standard">{{ $channels['name'] }}</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="accordion-item">
                                                            <div class="accordion-header" id="flush-headingTwo">
                                                                <div class="accordion-button collapsed"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapseTwo"
                                                                    aria-expanded="false">
                                                                    <div class="custom-form-check form-check mb-0">
                                                                        <label class="form-check-label"
                                                                            for="banking"><input
                                                                                class="form-check-input mt-0"
                                                                                type="radio" name="flexRadioDefault"
                                                                                id="banking">Retail
                                                                            Outlet</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="flush-collapseTwo"
                                                                class="accordion-collapse collapse"
                                                                data-bs-parent="#accordionFlushExample">
                                                                <div class="accordion-body">
                                                                    <div class="checkout-detail">
                                                                        <div class="row g-4">
                                                                            @foreach ($payment_channels['Convenience Store'] as $channels)
                                                                                <div class="col-xxl-6">
                                                                                    <div class="delivery-option">
                                                                                        <div class="delivery-category">
                                                                                            <div
                                                                                                class="shipment-detail text-center">
                                                                                                <img class="img-fluid"
                                                                                                    width="120px"
                                                                                                    src="{{ $channels['icon_url'] }}"
                                                                                                    alt="{{ $channels['name'] }}">
                                                                                                <div
                                                                                                    class="form-check custom-form-check hide-check-box mt-3">
                                                                                                    <input
                                                                                                        class="form-check-input"
                                                                                                        type="radio"
                                                                                                        name="payment_code"
                                                                                                        id="standard"
                                                                                                        value="{{ $channels['code'] }}">
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="standard">{{ $channels['name'] }}</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="right-side-summery-box">
                                <div class="summery-box-2">
                                    <div class="summery-header">
                                        <h3>Produk dipesan</h3>
                                    </div>

                                    <ul class="summery-contain">
                                        <li>
                                            <div class="card">
                                                <img src="{{ asset('storage/' . $product->photo) }}"
                                                    class="img-fluid blur-up lazyloaded" alt="...">
                                            </div>
                                        </li>
                                        <li class="mt-3">
                                            <h3>{{ $product->name }} </h3>
                                        </li>
                                    </ul>
                                    @if ($varian)
                                        <ul class="summery-total">
                                            <li>
                                                <h4>Status Produk</h4>
                                                <h4 class="price">
                                                    @if (ProductStatusEnum::PREORDER->value == $product->status)
                                                        Preorder
                                                    @else
                                                        Tersedia
                                                    @endif
                                                </h4>
                                            </li>
                                            <li>
                                                <h4>Harga</h4>
                                                @if ($product->varianProducts->isEmpty())
                                                    <h4 class="price">
                                                        {{ CurrencyHelper::rupiahCurrency($product->sell_price) }}
                                                    </h4>
                                                @else
                                                    <h4 class="price">
                                                        {{ CurrencyHelper::rupiahCurrency($product->varianProducts[0]->sell_price) }}
                                                    </h4>
                                                @endif
                                            </li>
                                            <li>
                                                <h4>Discount</h4>
                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                    @if ($product->discount_price == 1)
                                                        <h4 class="price">
                                                            {{ CurrencyHelper::rupiahCurrency($product->reseller_discount) }}
                                                        </h4>
                                                    @else
                                                        <h4 class="price">{{ $product->reseller_discount }}$</h4>
                                                    @endif
                                                @else
                                                    @if ($product->discount_price == 1)
                                                        <h4 class="price">
                                                            {{ CurrencyHelper::rupiahCurrency($product->discount) }}
                                                        </h4>
                                                    @else
                                                        <h4 class="price">{{ $product->discount }}$</h4>
                                                    @endif
                                                @endif
                                            </li>
                                            <li>
                                                <h4>Subtotal</h4>
                                                @php
                                                    if ($product->varianProducts->isEmpty()) {
                                                        $discount =
                                                            UserHelper::getUserRole() == UserRoleEnum::RESELLER->value
                                                                ? $product->reseller_discount
                                                                : $product->discount;

                                                        $subtotal = CurrencyHelper::countPriceAfterDiscount(
                                                            $product->sell_price,
                                                            $discount,
                                                            false,
                                                            $product->discount_price,
                                                        );
                                                    } else {
                                                        $discount =
                                                            UserHelper::getUserRole() == UserRoleEnum::RESELLER->value
                                                                ? $product->reseller_discount
                                                                : $product->discount;

                                                        $subtotal = CurrencyHelper::countPriceAfterDiscount(
                                                            $product->varianProducts[0]->sell_price,
                                                            $discount,
                                                            false,
                                                            $product->discount_price,
                                                        );
                                                    }
                                                @endphp
                                                {{-- @if ($product->varianProducts->isEmpty()) --}}
                                                <h4 class="price">{{ CurrencyHelper::rupiahCurrency($subtotal) }}</h4>
                                                {{-- @else
                                            <h4 class="price">{{CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount($product->varianProducts[0]->sell_price,$product->discount))}}</h4>
                                            @endif --}}
                                            </li>

                                            <li>
                                                <h4>Pajak (PPN)</h4>
                                                <h4 class="price">10%</h4>
                                            </li>

                                            <li class="list-total">
                                                <h4>Total</h4>
                                                {{-- @if ($product->varianProducts->isEmpty()) --}}
                                                <h4 class="price">
                                                    {{ CurrencyHelper::countPriceAfterTax($subtotal, 10, true) }}
                                                </h4>
                                                {{-- @else
                                            <h4 class="price">{{CurrencyHelper::countPriceAfterTax($subtotal,10,true)}}</h4>
                                            @endif --}}
                                            </li>
                                        </ul>
                                    @else
                                        <ul class="summery-total">
                                            <li>
                                                <h4>Status Produk</h4>
                                                <h4 class="price">
                                                    @if (ProductStatusEnum::PREORDER->value == $product->status)
                                                        Preorder
                                                    @else
                                                        Tersedia
                                                    @endif
                                                </h4>
                                            </li>
                                            <li>
                                                <h4>Harga</h4>
                                                <h4 class="price">
                                                    {{ CurrencyHelper::rupiahCurrency($product->sell_price) }}
                                                </h4>
                                            </li>
                                            <li>
                                                <h4>Discount</h4>
                                                @if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value)
                                                    @if ($product->discount_price == 1)
                                                        <h4 class="price">
                                                            {{ currencyHelper::rupiahCurrency($product->reseller_discount) }}
                                                        </h4>
                                                    @else
                                                        <h4 class="price">{{ $product->reseller_discount }}%</h4>
                                                    @endif
                                                @else
                                                    @if ($product->discount_price == 1)
                                                        <h4 class="price">
                                                            {{ CurrencyHelper::rupiahCurrency($product->discount) }}</h4>
                                                    @else
                                                        <h4 class="price">{{ $product->discount }}%</h4>
                                                    @endif
                                                @endif
                                            </li>
                                            <li>
                                                <h4>Subtotal</h4>
                                                @php

                                                    $discount =
                                                        UserHelper::getUserRole() == UserRoleEnum::RESELLER->value
                                                            ? $product->reseller_discount
                                                            : $product->discount;

                                                    $subtotal = CurrencyHelper::countPriceAfterDiscount(
                                                        $product->sell_price,
                                                        $discount,
                                                        false,
                                                        $product->discount_price,
                                                        
                                                    );
                                                @endphp
                                                <h4 class="price">{{ CurrencyHelper::rupiahCurrency($subtotal) }}</h4>
                                            </li>

                                            <li>
                                                <h4>Pajak (PPN)</h4>
                                                <h4 class="price">10%</h4>
                                            </li>

                                            <li class="list-total">
                                                <h4>Total</h4>
                                                <h4 class="price">
                                                    {{ CurrencyHelper::countPriceAfterTax($subtotal, 10, true) }}
                                                </h4>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                                @if ($product->status === ProductStatusEnum::AVAILABLE->value)
                                    @if ($product->licenses)
                                        <button type="submit"
                                            class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold">Beli Produk
                                        </button>
                                    @else
                                        <button class="btn btn-md bg-danger cart-button text-white w-100">Stok produk
                                            telah habis
                                        </button>
                                    @endif
                                @else
                                    <button type="submit"
                                        class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold">Beli Produk
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    @endif
@endsection
