@php use App\Helpers\CurrencyHelper; @endphp
@extends('dashboard.layouts.app')
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="title-header option-title">
                <h5>Produk: {{ $product->name }}</h5>
                <a class="btn btn-warning" href="{{ route('products.edit', $product) }}">Edit</a>
            </div>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button">Detail
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button">Lisensi
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-usage-tab" data-bs-toggle="pill" data-bs-target="#pills-usage"
                            type="button">Review
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                    <form class="theme-form theme-form-2 mega-form">
                        <div class="card-header-1"></div>

                        <div class="row">
                            <div class="col-md-3">
                                <img class="img img-fluid" src="{{ asset('storage/'. $product->photo) }}"
                                     alt="{{ $product->name }}">
                            </div>
                            <div class="col-md-9">
                                <div class="mb-4 row align-items-center">
                                    <table class="table variation-table table-responsive-sm">
                                        <thead>
                                        <tr>
                                            <th scope="col">Nama</th>
                                            <td>{{ $product->name }}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Kategori</th>
                                            <td>{{ $product->category->name }}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Harga Beli</th>
                                            <td>{{ CurrencyHelper::rupiahCurrency($product->buy_price) }}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Harga Jual</th>
                                            <td>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Jenis Pengguna</th>
                                            <th scope="col">Diskon</th>
                                            <th scope="col">Total Harga</th>
                                            <th scope="col"></th>
                                        </tr>
                                        <tr>
                                            <th scope="col">Customer</th>
                                            <td>
                                                {{ $product->discount . "%" }}
                                            </td>
                                            <td>
                                                {{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Reseller</th>
                                            <td>
                                                {{ $product->reseller_discount . "%" }}
                                            </td>
                                            <td>
                                                <span
                                                    id="reseller_label">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->reseller_discount, true) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Buku Panduan</th>
                                            <td>
                                                <a style="width: 30%" target="_blank" class="btn btn-danger"
                                                   href="{{ asset('storage/' . $product->attachment_file) }}"> Lihat
                                                    File
                                                </a>
                                            </td>
                                        </tr>

                                        </thead>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="pills-profile" role="tabpanel">
                    <form class="theme-form theme-form-2 mega-form">
                        <div class="card-header-1">
                            <h5>Restriction</h5>
                        </div>

                        <div class="row">
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-lg-2 col-md-3 mb-0">Products</label>
                                <div class="col-md-9 col-lg-10">
                                    <input class="form-control" type="text">
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-2 col-form-label form-label-title">Category</label>
                                <div class="col-sm-10">
                                    <select class="js-example-basic-single select2-hidden-accessible" name="state"
                                            data-select2-id="select2-data-4-ug6b" tabindex="-1" aria-hidden="true">
                                        <option disabled="">--Select--</option>
                                        <option data-select2-id="select2-data-6-j89i">Electronics</option>
                                        <option>Clothes</option>
                                        <option>Shoes</option>
                                        <option>Digital</option>
                                    </select><span class="select2 select2-container select2-container--default"
                                                   dir="ltr" data-select2-id="select2-data-5-7qcw" style="width: auto;"><span
                                            class="selection"><span class="select2-selection select2-selection--single"
                                                                    role="combobox" aria-haspopup="true"
                                                                    aria-expanded="false" tabindex="0"
                                                                    aria-disabled="false"
                                                                    aria-labelledby="select2-state-nm-container"
                                                                    aria-controls="select2-state-nm-container"><span
                                                    class="select2-selection__rendered" id="select2-state-nm-container"
                                                    role="textbox" aria-readonly="true"
                                                    title="Electronics">Electronics</span><span
                                                    class="select2-selection__arrow" role="presentation"><b
                                                        role="presentation"></b></span></span></span><span
                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <label class="col-lg-2 col-md-3 col-form-label form-label-title">Minimum
                                    Spend</label>
                                <div class="col-md-9 col-lg-10">
                                    <input class="form-control" type="number">
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <label class="col-lg-2 col-md-3 col-form-label form-label-title">Maximum
                                    Spend</label>
                                <div class="col-md-9 col-lg-10">
                                    <input class="form-control" type="number">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="pills-usage" role="tabpanel">
                    <form class="theme-form theme-form-2 mega-form">
                        <div class="card-header-1">
                            <h5>Usage Limits</h5>
                        </div>

                        <div class="row">
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-lg-2 col-md-3 mb-0">Per
                                    Limited</label>
                                <div class="col-md-9 col-lg-10">
                                    <input class="form-control" type="number">
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <label class="form-label-title col-lg-2 col-md-3 mb-0">Per
                                    Customer</label>
                                <div class="col-md-9 col-lg-10">
                                    <input class="form-control" type="number">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(() => {

            CKEDITOR.replace('editor');

        });
    </script>
@endsection
