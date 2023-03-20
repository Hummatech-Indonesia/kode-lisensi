@extends('dashboard.layouts.app')
@section('content')
    <form enctype="multipart/form-data" method="POST" class="theme-form theme-form-2 mega-form"
          action="{{ route('products.update', $product) }}">
        @csrf
        @method("PATCH")
        <div class="col-sm-12 m-auto">
            @if($errors->any())
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
                        <label class="form-label-title col-sm-3 mb-0">Nama Produk <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input value="{{ $product->name }}" autocomplete="off" name="name" class="form-control"
                                   type="text"
                                   placeholder="Windows 10 Professional">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-3 col-form-label form-label-title">Kategori Produk <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="category_id">
                                @foreach($categories as $category)
                                    <option
                                        {{ $product->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>


                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Harga Produk</h5>
                    </div>

                    <table class="table variation-table table-responsive-sm">
                        <div class="mb-4 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0">Harga Beli <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input value="{{ $product->buy_price }}" min="0" autocomplete="off" name="buy_price"
                                       class="form-control" type="number"
                                       placeholder="100000">
                            </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0">Harga Jual <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input value="{{ $product->sell_price }}" id="sell_price" min="0" autocomplete="off"
                                       name="sell_price" class="form-control"
                                       type="text"
                                       placeholder="250000">
                            </div>
                        </div>

                        <thead>
                        <tr>
                            <th scope="col">Jenis Pengguna</th>
                            <th scope="col">Diskon <span
                                    class="text-danger">* (0-100%)</span></th>
                            <th scope="col">Total Harga</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Customer</td>
                            <td>
                                <input min="0" max="100" id="discount" name="discount" value="{{ $product->discount }}"
                                       class="form-control"
                                       type="number">
                            </td>
                            <td>
                                <span id="customer_label">Rp. 0</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Reseller</td>
                            <td>
                                <input value="{{ $product->reseller_discount }}" id="reseller_discount"
                                       name="reseller_discount" class="form-control"
                                       type="number" placeholder="0">
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
                                <option {{ $product->status == 'stocking' ? 'selected' : '' }} value="stocking">Stock
                                    Produk
                                </option>
                                <option {{ $product->status == 'preorder' ? 'selected' : '' }} value="preorder">
                                    Preorder
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
                                <option {{ $product->type == 'credential' ? 'selected' : '' }} value="credential">
                                    Username & Password
                                </option>
                                <option {{ $product->type == 'serial' ? 'selected' : '' }} value="serial">Serial Key
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Deskripsi</h5>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-5">
                            <div class="row">
                                <label class="form-label-title col-sm-3 mb-0">Produk <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="editor"
                                              name="description">{{ $product->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <label class="form-label-title col-sm-3 mb-0">Panduan Penggunaan <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="installation"
                                              name="installation">{{ $product->installation }}</textarea>
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
                                    <li>Berkas Panduan harus berupa pdf dengan ukuran maksimal 20Mb</li>
                                    <li>Pastikan nama file berkas berbeda tiap produknya</li>
                                </ul>

                            </div>
                        </div>

                    </div>

                    <div class="mb-4 row align-items-center">
                        <label
                            class="col-sm-3 col-form-label form-label-title"></label>
                        <div class="col-sm-9">
                            <img style="width: 200px;" class="img-fluid" src="{{ asset('storage/'. $product->photo) }}"
                                 alt="{{ $product->photo }}">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label
                            class="col-sm-3 col-form-label form-label-title">Foto Produk <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input name="photo" class="form-control form-choose" type="file">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-3 col-form-label form-label-title">Berkas Panduan <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input name="attachment_file" class="form-control form-choose" type="file">
                        </div>
                        <div class="col-sm-3">
                            <a href="{{ asset('storage/' . $product->attachment_file) }}" class="btn btn-danger btn-sm"
                               target="_blank"><i class="ri-file-line"></i> Lihat Berkas File</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="ml-3 mb-4 row align-items-center">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit"><i class="ri-edit-line ri-1x me-2"></i>Update
                            Data
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

            let discount = $('#discount')
            let reseller = $('#reseller_discount')

            let seller_price = null

            CKEDITOR.replace('editor');
            CKEDITOR.replace('installation');

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

            const initDiscount = () => {
                let seller_price = $('#sell_price').val()
                const customer_discount = calculateDiscount(seller_price, discount.val())
                const reseller_discount = calculateDiscount(seller_price, reseller.val())

                if (discount.val() >= 0 || discount.val() <= 100) {
                    $('#customer_label').text(convertRupiah(customer_discount))
                }

                if (reseller.val() >= 0 || reseller.val() <= 100) {
                    $('#reseller_label').text(convertRupiah(reseller_discount))
                }
            }

            $('#sell_price').change((e) => {
                seller_price = $('#sell_price').val()
            })

            $('#convert_button').click((e) => {
                initDiscount();
            })

            discount.on('keyup', function (evt) {
                ["e", "E", "+", "-"].includes(evt.key) && evt.preventDefault();
            })

            reseller.on('keyup', function (evt) {
                ["e", "E", "+", "-"].includes(evt.key) && evt.preventDefault();
            })

            initDiscount();
        });
    </script>
@endsection
