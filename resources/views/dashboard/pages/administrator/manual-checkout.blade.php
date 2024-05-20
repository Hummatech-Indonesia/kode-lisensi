@php
    use App\Enums\ProductStatusEnum;
    use App\Enums\ProductTypeEnum;
    use App\Enums\UserRoleEnum;
    use App\Helpers\CurrencyHelper;
    use App\Helpers\UserHelper;
@endphp
@extends('dashboard.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <h3 class="title mb-3">Form Penambahan Transaksi Manual</h3>
                <div class="mb-3">
                    <label for="" class="form-label">Nama Pengguna</label>
                    <input type="text" name="name" id="" class="form-control"
                        value="{{ auth()->user()->name }}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="email" id="" value="{{ auth()->user()->email }}"
                        class="form-control">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Nomor Telepon</label>
                    <input type="number" name="phone_number" id="" value="{{ auth()->user()->phone_number }}"
                        class="form-control" placeholder="081335574634">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Catatan (opsional)</label>
                    <textarea name="note" id="" cols="15" rows="5" class="form-control"
                        placeholder="Catatan pemesanan.."></textarea>
                </div>
            </div>
            <div class="card">
                <div class="checkout-box">
                    <div class="checkout-title">
                        <h4>Pilih Metode Pembayaran</h4>
                    </div>

                    <div class="checkout-detail">
                        <div class="accordion accordion-flush custom-accordion" id="accordionFlushExample">
                            <div class="accordion-item">
                                <div class="accordion-header" id="flush-headingFour">
                                    <div class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseFour" aria-expanded="true">
                                        <div class="custom-form-check form-check mb-0">
                                            <label class="form-check-label" for="cash"><input
                                                    class="form-check-input mt-0" type="radio" name="flexRadioDefault"
                                                    id="cash" checked=""> Virtual
                                                Account</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="flush-collapseFour" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionFlushExample" style="">
                                    <div class="accordion-body">
                                        <div class="checkout-detail">
                                            <div class="row g-4">
                                                @foreach ($payment_channels['Virtual Account'] as $channels)
                                                    <div class="col-xxl-6">
                                                        <div class="delivery-option">
                                                            <div class="delivery-category">
                                                                <div class="shipment-detail text-center">
                                                                    <img class="img-fluid" width="120px"
                                                                        src="{{ $channels['icon_url'] }}"
                                                                        alt="{{ $channels['name'] }}">
                                                                    <div
                                                                        class="form-check custom-form-check hide-check-box mt-3">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="payment_code" id="standard"
                                                                            value="{{ $channels['code'] }}">
                                                                        <label class="form-check-label"
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
                                    <div class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne" aria-expanded="false">
                                        <div class="custom-form-check form-check mb-0">
                                            <label class="form-check-label" for="credit"><input
                                                    class="form-check-input mt-0" type="radio" name="flexRadioDefault"
                                                    id="credit">
                                                E-wallet</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="checkout-detail">
                                            <div class="row g-4">
                                                @foreach ($payment_channels['E-Wallet'] as $channels)
                                                    <div class="col-xxl-6">
                                                        <div class="delivery-option">
                                                            <div class="delivery-category">
                                                                <div class="shipment-detail text-center">
                                                                    <img class="img-fluid" width="120px"
                                                                        src="{{ $channels['icon_url'] }}"
                                                                        alt="{{ $channels['name'] }}">
                                                                    <div
                                                                        class="form-check custom-form-check hide-check-box mt-3">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="payment_code" id="standard"
                                                                            value="{{ $channels['code'] }}">
                                                                        <label class="form-check-label"
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
                                    <div class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseTwo" aria-expanded="false">
                                        <div class="custom-form-check form-check mb-0">
                                            <label class="form-check-label" for="banking"><input
                                                    class="form-check-input mt-0" type="radio" name="flexRadioDefault"
                                                    id="banking">Retail
                                                Outlet</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="checkout-detail">
                                            <div class="row g-4">
                                                @foreach ($payment_channels['Convenience Store'] as $channels)
                                                    <div class="col-xxl-6">
                                                        <div class="delivery-option">
                                                            <div class="delivery-category">
                                                                <div class="shipment-detail text-center">
                                                                    <img class="img-fluid" width="120px"
                                                                        src="{{ $channels['icon_url'] }}"
                                                                        alt="{{ $channels['name'] }}">
                                                                    <div
                                                                        class="form-check custom-form-check hide-check-box mt-3">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="payment_code" id="standard"
                                                                            value="{{ $channels['code'] }}">
                                                                        <label class="form-check-label"
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
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="">
                    <h3>Produk dipesan</h3>
                    <hr>
                </div>
                <div class="">
                    <img src="{{ asset('storage/' . $product->photo) }}" alt="Product.png" class="img-fluid container">
                    <h3 id="nameProduct" class="mt-1 mb-1">{{ $product->name }}</h3>
                    <hr>
                </div>
                <div class="d-flex justify-content-between mb-1">
                    <div class="">
                        <h4>Status Produk</h4>
                    </div>
                    <div class="">
                        @if (ProductStatusEnum::PREORDER->value)
                            <h4 id="statusProduct">Preorder</h4>
                        @else
                            <h4 id="statusProduct">Stock</h4>
                        @endif
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-1">
                    <div class="">
                        <h4>Harga</h4>
                    </div>
                    <div class="">
                        <h4>{{ CurrencyHelper::RupiahCurrency($product->sell_price) }}</h4>
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-1">
                    <div class="">
                        <h4>Diskon</h4>
                    </div>
                    <div class="">
                        <h4>{{ $product->discount }}</h4>
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-1">
                    <div class="">
                        <h4>Subtotal</h4>
                    </div>
                    <div class="">
                        <h4>{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}
                        </h4>
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-1">
                    <div class="">
                        <h4>Pajak(PPN)</h4>
                    </div>
                    <div class="">
                        <h4>10%</h4>
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-1">
                    <div class="">
                        <h4 class="fw-bold">Total</h4>
                    </div>
                    <div class="">
                        <h4 class="fw-bold">{{$product->sell_price}}</h4>
                    </div>
                </div>
                <hr>
                @if ($product->status === ProductStatusEnum::AVAILABLE->value)
                    @if ($product->licenses)
                        <button type="submit" class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold">Beli Produk
                        </button>
                    @else
                        <button class="btn btn-md bg-danger cart-button text-white w-100">Stok produk
                            telah habis
                        </button>
                    @endif
                @else
                    <button type="submit" class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold">Beli Produk
                    </button>
                @endif
            </div>
        </div>
    </div>
@endsection
