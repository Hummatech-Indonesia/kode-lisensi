@extends('dashboard.layouts.app')
@section('content')
    <form enctype="multipart/form-data" method="POST" id="form" class="theme-form theme-form-2 mega-form"
        action="{{ route('products.store') }}">
        @csrf
        <div class="col-sm-12 m-auto">
            @if ($errors->any())
                <x-validation-errors :errors="$errors"></x-validation-errors>
            @elseif(session('error'))
                <x-alert-failed></x-alert-failed>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Informasi Produk</h5>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-3 mb-0">Nama <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input value="{{ old('name') }}" autocomplete="off" name="name" class="form-control"
                                type="text" placeholder="Windows 10 Professional">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-3 col-form-label form-label-title">Kategori <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-3 mb-0">Deskripsi singkat <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input value="{{ old('short_description') }}" autocomplete="off" name="short_description"
                                class="form-control" type="text"
                                placeholder="Lisensi ori windows 10 professional untuk perorangan">
                        </div>
                    </div>
                    <div class="mb-4 row d-flex align-items-center justify-content-end">
                        <div id="variant_product">
                            <button type="button" class="btn btn-sm btn-primary col-sm-3 d-flex align-items-center">Tambah Variasi
                                Produk
                            </button>
                            <p class="mt-2" style="color: #0DA487">Klik tambah variasi produk, jika produk yang ingin
                                anda
                                tambahkan terdapat
                                variannya</p>
                        </div>
                        <div id="cancel_variant_product" style="display: none;">
                            <button type="button" class="btn btn-sm btn-primary col-sm-3"> Batal Tambah Variasi
                                Produk
                            </button>
                            <p class="mt-2" style="color: #0DA487">Klik batal tambah variasi produk, jika produk yang
                                ingin anda
                                tambahkan tidak terdapat
                                variannya</p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card" id="discount_varian_product" style="display: none;">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Tambahkan Diskon Pengguna</h5>
                    </div>

                    <table class="table variation-table table-responsive-sm">
                        <thead>
                            <tr>
                                <th scope="col">Jenis Pengguna</th>
                                <th scope="col">Diskon <span class="text-danger">* (0-100%)</span></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Customer</td>
                                <td>
                                    <input min="0" max="100" id="discount_variant" name="discount_varian"
                                        value="{{ old('discount_varian') }}" class="form-control" type="number" placeholder="0">
                                </td>
                            </tr>
                            <tr>
                                <td>Reseller</td>
                                <td>
                                    <input value="{{ old('reseller_discount_varian') }}" id="reseller_discount_varian"
                                        name="reseller_discount_varian" class="form-control" type="number" placeholder="0">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="varian_product card" style="display: none;">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Tambahkan Variasi Produk</h5>
                    </div>

                    <table class="table variation-table table-responsive-sm">
                        <div class="mb-4 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0">Nama Varian <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input min="0" autocomplete="off" name="name_varian[]" class="form-control"
                                    type="text" placeholder="1 Bulan">
                            </div>
                        </div>
                        <div class="mb-4 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0">Harga Beli <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input min="0" autocomplete="off" name="buy_price_varian[]" class="form-control"
                                    type="number" placeholder="100.000">
                            </div>
                        </div>
                        <div class="mb-4 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0">Harga Jual <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input id="sell_price_varian" min="0" autocomplete="off"
                                    name="sell_price_varian[]" class="form-control" type="text" placeholder="250.000">
                            </div>
                        </div>
                    </table>
                    <table class="table table-responsive-sm variation-table mb-3">
                        <thead>
                            <tr>
                                <th scope="col">Jenis Pengguna</th>
                                <th scope="col">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Customer</td>
                                <td><span>Rp.0</span></td>
                            </tr>
                            <tr>
                                <td>Reseller</td>
                                <td><span>Rp.0</span></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex gap-3 justify-content-between align-items-center">
                        <button type="button" class="btn btn-sm btn-primary justify-content-start">Konversi harga
                        </button>
                        <div class="d-flex gap-3">
                            <button type="button" class="add_varian btn btn-sm btn-primary">Tambah Variasi
                                Produk
                            </button>
                            <button type="button" class="delete_varian btn btn-sm btn-danger"
                            style="display: none;"><i class="fa fa-trash"></i>Hapus Variasi Product
                        </button>
                    </div>
                    </div>
                </div>
            </div>

            <div class="card" id="price">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Harga Produk</h5>
                    </div>
                    <table class="table variation-table table-responsive-sm">
                        <div class="mb-4 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0">Harga Beli <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input min="0" autocomplete="off" name="buy_price" class="form-control"
                                    type="number" placeholder="100000" value="{{old('buy_price')}}">
                            </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0">Harga Jual <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input id="sell_price" min="0" autocomplete="off" name="sell_price"
                                    class="form-control" type="text" placeholder="250000" value="{{old('sell_price')}}">
                            </div>
                        </div>

                        <thead>
                            <tr>
                                <th scope="col">Jenis Pengguna</th>
                                <th scope="col">Diskon <span class="text-danger">* (0-100%)</span></th>
                                <th scope="col">Total Harga</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Customer</td>
                                <td>
                                    <input min="0" max="100" id="discount" name="discount"
                                        value="{{ old('discount') }}" class="form-control" type="number" placeholder="0">
                                </td>
                                <td>
                                    <span id="customer_label">Rp. 0</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Reseller</td>
                                <td>
                                    <input value="{{ old('reseller_discount') }}" id="reseller_discount"
                                        name="reseller_discount" class="form-control" type="number" placeholder="0">
                                </td>
                                <td>
                                    <span id="reseller_label">Rp. 0</span>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button id="convert_button" type="button" class="btn btn-sm btn-primary">Konversi
                                        Harga
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Lisensi </h5>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-3 mb-0">Tipe Lisensi <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status">
                                <option>--Pilih--</option>
                                <option {{ old('status') == 'stocking' ? 'selected' : '' }} value="stocking">Stock
                                    Produk
                                </option>
                                <option {{ old('status') == 'preorder' ? 'selected' : '' }} value="preorder">Preorder
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-3 mb-0">Jenis Lisensi <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="type">
                                <option>--Pilih--</option>
                                <option {{ old('type') == 'credential' ? 'selected' : '' }} value="credential">Username
                                    & Password
                                </option>
                                <option {{ old('type') == 'serial' ? 'selected' : '' }} value="serial">Serial
                                    Key
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Detail</h5>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-5">
                            <div class="col">
                                <label class="form-label-title col-sm-3 mb-0">Deskripsi<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="editor" name="description">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-5">
                            <div class="col">
                                <label class="form-label-title col-sm-3 mb-0">Fitur <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="features" name="features">{{ old('features') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col">
                                <label class="form-label-title col-sm-3 mb-0">Panduan Penggunaan <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="installation" name="installation">{{ old('installation') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Foto Produk dan Panduan Penggunaan</h5>
                        <div class="col-sm-6 mt-3">
                            <div class="alert alert-warning">
                                Catatan: <br>
                                <ul>
                                    <li>Foto Produk harus berupa jpg,png,jpeg dengan ukuran maksimal 5Mb</li>
                                    {{-- <li>Berkas Panduan harus berupa pdf dengan ukuran maksimal 20Mb</li>
                                    <li>Pastikan nama file berkas berbeda tiap produknya</li> --}}
                                </ul>

                            </div>
                        </div>

                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-3 col-form-label form-label-title">Foto <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input name="photo" class="form-control form-choose" type="file">
                        </div>
                    </div>

                    {{-- <div class="row align-items-center">
                        <label class="col-sm-3 col-form-label form-label-title">Berkas Panduan <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input name="attachment_file" class="form-control form-choose" type="file">
                        </div>
                    </div> --}}
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="ml-3 mb-4 d-flex align-items-center justify-content-end">
                        <button class="btn btn-primary" type="submit">Tambah
                            Produk
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection
@section('script')
    <script>
        $(document).ready(() => {

            CKEDITOR.replace('editor');
            CKEDITOR.replace('installation');
            CKEDITOR.replace('features');

            const calculateDiscount = (price, discount) => {
                const total = price * (discount / 100)

                return price - total
            }

            const convertRupiah = (number) => {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                }).format(number);
            }


            let discount = $('#discount')
            let reseller = $('#reseller_discount')

            let seller_price = null

            $('#sell_price').change((e) => {
                seller_price = $('#sell_price').val()
            })

            $('#convert_button').click((e) => {
                const customer_discount = calculateDiscount(seller_price, discount.val())
                const reseller_discount = calculateDiscount(seller_price, reseller.val())

                if (discount.val() >= 0 || discount.val() <= 100) {
                    $('#customer_label').text(convertRupiah(customer_discount))
                }

                if (reseller.val() >= 0 || reseller.val() <= 100) {
                    $('#reseller_label').text(convertRupiah(reseller_discount))
                }

            })

            discount.on('keyup', function(evt) {
                ["e", "E", "+", "-"].includes(evt.key) && evt.preventDefault();
            })

            reseller.on('keyup', function(evt) {
                ["e", "E", "+", "-"].includes(evt.key) && evt.preventDefault();
            })

        });

        $(document).ready(function() {
            $("#variant_product").click(function() {
                $("#price").hide();
                $("#variant_product").hide();
                $("#cancel_variant_product").removeAttr("style").css("display", "block");
                $("#discount_varian_product").removeAttr("style").css("display", "block");
                $(".varian_product").removeAttr("style").css("display", "block");
                $("#form").attr("action", "{{ route('varian.products.store') }}");
            });
            $("#cancel_variant_product").click(function() {
                $("#price").show();
                $("#variant_product").show();
                $("#cancel_variant_product").removeAttr("style").css("display", "none");
                $("#discount_varian_product").removeAttr("style").css("display", "none");
                $(".varian_product").removeAttr("style").css("display", "none");
                $("#form").attr("action", "{{ route('products.store') }}");
            });
        });

        $(document).ready(function(id) {
            $(document).on("click", ".add_varian", function() {
                var duplicatedVarian = $(".varian_product").last().clone();
                duplicatedVarian.insertAfter(".varian_product:last");
                $(".delete_varian:last").removeAttr("style").css("display", "block");
            });
        });

        $(document).ready(function() {
            $(document).on("click", ".delete_varian", function() {
                $(".varian_product:last").remove();
            });
        });
    </script>
@endsection
