@extends('dashboard.layouts.app')
@section('content')
    <form enctype="multipart/form-data" method="POST" id="form" class="theme-form theme-form-2 mega-form"
        action="{{ route('varian.products.update', $product->id) }}">
        @method('PATCH')
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
                            <input value="{{ old('name', $product->name) }}" autocomplete="off" name="name"
                                class="form-control" type="text" placeholder="Windows 10 Professional">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-3 col-form-label form-label-title">Kategori <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $product->category_id = $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-3 mb-0">Deskripsi singkat <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input value="{{ old('short_description', $product->short_description) }}" autocomplete="off"
                                name="short_description" class="form-control" type="text"
                                placeholder="Lisensi ori windows 10 professional untuk perorangan">
                        </div>
                    </div>
                    <div class="mb-4 row align-items-center justify-content-end" style="display: none;">
                        <div id="variant_product">
                            <button type="button" class="btn btn-sm btn-primary col-sm-3"><i><svg
                                        xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                                    </svg></i>Tambah Variasi
                                Produk
                            </button>
                            <p class="mt-2" style="color: #0DA487">Klik tambah variasi produk, jika produk yang ingin
                                anda
                                tambahkan terdapat
                                variannya</p>
                        </div>
                        <div id="cancel_variant_product" style="display: none;">
                            <button type="button" class="btn btn-sm btn-primary col-sm-3"><i><svg
                                        xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22" />
                                    </svg></i> Batal Tambah Variasi
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
            <div class="card" id="discount_varian_product">
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
                                        value="{{ old('discount_varian', $product->discount) }}" class="form-control"
                                        type="number" placeholder="0">
                                </td>
                            </tr>
                            <tr>
                                <td>Reseller</td>
                                <td>
                                    <input value="{{ old('reseller_discount_varian', $product->reseller_discount) }}"
                                        id="reseller_discount_varian" name="reseller_discount_varian" class="form-control"
                                        type="number" placeholder="0">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @foreach ($product->varianProducts as $varianProduct)
                <div class="varian_product card">
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
                                        type="text" placeholder="1 Bulan" value="{{ $varianProduct->name }}">
                                </div>
                            </div>
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Harga Beli <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input min="0" autocomplete="off" name="buy_price_varian[]"
                                        class="form-control" type="number" placeholder="100000"
                                        value="{{ $varianProduct->buy_price }}">
                                </div>
                            </div>
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Harga Jual <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input min="0" autocomplete="off" name="sell_price_varian[]"
                                        class="sell_price_varian form-control" type="text" placeholder="250000"
                                        value="{{ $varianProduct->sell_price }}">
                                </div>
                            </div>
                        </table>
                        <table class="table variation-table table-responsive-sm" style="width: 75%; margin-bottom:1rem;">
                            <thead>
                                <tr>
                                    <th scope="col">Jenis Pengguna</th>
                                    <th scope="col">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Customer</td>
                                    <td>
                                        <span class="customer_label_varian">Rp. 0</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Reseller</td>
                                    <td>
                                        <span class="reseller_label_varian">Rp. 0</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button class="convert_button_varian btn btn-sm btn-primary"
                                            type="button">Konversi
                                            Harga
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex gap-3 justify-content-end align-items-center">
                            <button type="button" class="add_varian btn btn-sm btn-primary col-sm-3"><i><svg
                                        xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h11.175q.4 0 .763.15t.637.425l2.85 2.85q.275.275.425.638t.15.762V19q0 .825-.587 1.413T19 21zm7-3q1.25 0 2.125-.875T15 15q0-1.25-.875-2.125T12 12q-1.25 0-2.125.875T9 15q0 1.25.875 2.125T12 18m-5-8h7q.425 0 .713-.288T15 9V7q0-.425-.288-.712T14 6H7q-.425 0-.712.288T6 7v2q0 .425.288.713T7 10" />
                                    </svg></i>Tambah Variasi
                                Produk
                            </button>
                            <button type="button" class="delete_varian btn btn-sm btn-danger col-sm-3"
                                style="display: none;"><i class="fa fa-trash"></i>Hapus Variasi Product
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="card" id="price" style="display: none;">
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
                                    type="number" placeholder="100000" value="{{ old('buy_price') }}">
                            </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0">Harga Jual <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input id="sell_price" min="0" autocomplete="off" name="sell_price"
                                    class="form-control" type="text" placeholder="250000"
                                    value="{{ old('sell_price') }}">
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
                                        value="{{ old('discount') }}" class="form-control" type="number"
                                        placeholder="0">
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
                                <option {{ old('status', $product->status) == 'stocking' ? 'selected' : '' }}
                                    value="stocking">Stock
                                    Produk
                                </option>
                                <option {{ old('status', $product->status) == 'preorder' ? 'selected' : '' }}
                                    value="preorder">Preorder
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
                                <option {{ old('type', $product->type) == 'credential' ? 'selected' : '' }}
                                    value="credential">Username
                                    & Password
                                </option>
                                <option {{ old('type', $product->type) == 'serial' ? 'selected' : '' }} value="serial">
                                    Serial
                                    Key
                                </option>
                                <option {{ old('type', $product->type) == 'description' ? 'selected' : '' }}
                                    value="description">
                                    Deskripsi
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
                                    <textarea class="form-control" id="editor" name="description">{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-5">
                            <div class="col">
                                <label class="form-label-title col-sm-3 mb-0">Fitur <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="features" name="features">{{ old('features', $product->features) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col">
                                <label class="form-label-title col-sm-3 mb-0">Panduan Penggunaan <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="installation" name="installation">{{ old('installation', $product->installation) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Foto Produk</h5>
                        <div class="col-sm-6 mt-3">
                            <div class="alert alert-warning">
                                Catatan: <br>
                                <ul>
                                    <li>Foto Produk harus berupa jpg,png,jpeg dengan ukuran maksimal 5Mb</li>
                                </ul>

                            </div>
                        </div>

                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-3 col-form-label form-label-title"></label>
                        <div class="col-sm-9">
                            <img style="width: 200px;" class="img-fluid" src="{{ asset('storage/' . $product->photo) }}"
                                alt="{{ $product->photo }}">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-3 col-form-label form-label-title">Foto <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input name="photo" class="form-control form-choose" type="file">
                        </div>
                    </div>



                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="ml-3 mb-4 d-flex align-items-center justify-content-end">
                        <button class="btn btn-primary" type="submit"><i><svg xmlns="http://www.w3.org/2000/svg"
                                    width="17" height="17" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="m17.3 20.3l-2.6-2.6q-.275-.275-.275-.7t.275-.7q.275-.275.7-.275t.7.275l.9.9v-3.175q0-.425.288-.712t.712-.288q.425 0 .713.288t.287.712V17.2l.9-.9q.275-.275.7-.275t.7.275q.275.275.275.7t-.275.7l-2.6 2.6q-.3.3-.7.3t-.7-.3M15 24q-.425 0-.712-.288T14 23q0-.425.288-.712T15 22h6q.425 0 .713.288T22 23q0 .425-.288.713T21 24zm-9-4q-.825 0-1.412-.587T4 18V4q0-.825.588-1.412T6 2h6.175q.4 0 .763.15t.637.425l4.85 4.85q.275.275.425.638t.15.762v1.2q0 .425-.288.712t-.712.288h-4q-.825 0-1.412.588T12 13.025V19q0 .425-.288.713T11 20zm7.5-11H17l-5-5l5 5l-5-5v3.5q0 .625.438 1.063T13.5 9" />
                                </svg></i>Simpan Perubahan
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

                if (discount.val() >= 0 && discount.val() <= 100) {
                    $('#customer_label').text(convertRupiah(customer_discount))
                } else {

                    $('#customer_label').text(convertRupiah(seller_price))
                }

                if (reseller.val() >= 0 && reseller.val() <= 100) {
                    $('#reseller_label').text(convertRupiah(reseller_discount))
                } else {

                    $('#reseller_label').text(convertRupiah(seller_price))
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

        $(document).ready(function() {
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
        $(document).on('click', '.convert_button_varian', function() {
            const convertRupiah = (number) => {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                }).format(number);
            }
            let row = $(this).closest('.varian_product');
            let sellPrice = row.find('.sell_price_varian').val();

            let reseller_discount = $('#reseller_discount_varian').val();
            let discount = $('#discount_variant').val();

            let result_discount = sellPrice - (discount / 100 * sellPrice);
            let result_reseller_discount = sellPrice - (reseller_discount / 100 * sellPrice);
            if (reseller_discount >= 0 && reseller_discount <= 100) {
                row.find('.reseller_label_varian').text(convertRupiah(result_reseller_discount));
            } else {
                row.find('.reseller_label_varian').text(convertRupiah(sellPrice));
            }

            if (discount >= 0 && discount <= 100) {

                row.find('.customer_label_varian').text(convertRupiah(result_discount));
            } else {
                row.find('.customer_label_varian').text(convertRupiah(sellPrice));

            }
        });
    </script>
@endsection
