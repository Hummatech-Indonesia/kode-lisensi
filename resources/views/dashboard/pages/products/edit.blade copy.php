@extends('dashboard.layouts.app')
@section('content')
    <form enctype="multipart/form-data" method="POST" class="theme-form theme-form-2 mega-form"
        action="{{ route('products.update', $product) }}">
        @csrf
        @method('PATCH')
        <div class="col-sm-12 m-auto">
            <div class="mb-4 row align-items-center d-flex justify-content-between">
                <div class="col-sm-2">
                    <a href="{{ route('products.show', $product) }}" class="btn btn-warning"><i class="ri-arrow-left-line"></i>
                        Kembali</a>
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-primary" type="submit"><i><svg xmlns="http://www.w3.org/2000/svg" width="17"
                                height="17" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M21 7v12q0 .825-.587 1.413T19 21H5q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h12zm-9 11q1.25 0 2.125-.875T15 15q0-1.25-.875-2.125T12 12q-1.25 0-2.125.875T9 15q0 1.25.875 2.125T12 18m-6-8h9V6H6z" />
                            </svg></i>Update
                        Data
                </div>
                </button>
            </div>

            {{-- <div class="card">
                <div class="card-body">
                    <div class="ml-3 mb-4 row align-items-center">
                        <div class="col-sm-12"> --}}
            {{-- </div>
                    </div>
                </div>
            </div> --}}


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
                            <input value="{{ $product->name }}" autocomplete="off" name="name" class="form-control"
                                type="text" placeholder="Windows 10 Professional">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-3 col-form-label form-label-title">Kategori <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="category_id">
                                @foreach ($categories as $category)
                                    <option {{ $product->category_id == $category->id ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-3 mb-0">Deskripsi singkat <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input id="short_description_input" value="{{ $product->short_description }}" autocomplete="off"
                                name="short_description" class="form-control" type="text"
                                placeholder="Lisensi ori windows 10 professional untuk perorangan">
                            <span id="char_count"></span>
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
                                    class="form-control" type="number" placeholder="100000">
                            </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0">Harga Jual <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input value="{{ $product->sell_price }}" id="sell_price" min="0" autocomplete="off"
                                    name="sell_price" class="form-control" type="text" placeholder="250000">
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
                                        value="{{ $product->discount }}" class="form-control" type="number">
                                </td>
                                <td>
                                    <span id="customer_label">Rp. 0</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Reseller</td>
                                <td>
                                    <input value="{{ $product->reseller_discount }}" id="reseller_discount"
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
                                <option {{ $product->type == 'description' ? 'selected' : '' }} value="description">
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
                            <div class="row">
                                <label class="form-label-title col-sm-3 mb-0">Deskripsi <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="editor" name="description">{{ $product->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-5">
                            <div class="row">
                                <label class="form-label-title col-sm-3 mb-0">Fitur <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="features" name="features">{{ $product->features }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <label class="form-label-title col-sm-3 mb-0">Panduan Penggunaan <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="installation" name="installation">{{ $product->installation }}</textarea>
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

            const initDiscount = () => {
                let seller_price = $('#sell_price').val()
                const customer_discount = calculateDiscount(seller_price, discount.val())
                const reseller_discount = calculateDiscount(seller_price, reseller.val())

                if (discount.val() >= 0 && discount.val() <= 100) {
                    $('#customer_label').text(convertRupiah(customer_discount))
                } else {
                    $('#customer_label').text(convertRupiah($('#sell_price').val()));
                }

                if (reseller.val() >= 0 && reseller.val() <= 100) {
                    $('#reseller_label').text(convertRupiah(reseller_discount))
                } else {
                    $('#reseller_label').text(convertRupiah($('#sell_price').val()));
                }
            }

            $('#sell_price').change((e) => {
                seller_price = $('#sell_price').val()
            })

            $('#convert_button').click((e) => {
                initDiscount();
            })

            discount.on('keyup', function(evt) {
                ["e", "E", "+", "-"].includes(evt.key) && evt.preventDefault();
            })

            reseller.on('keyup', function(evt) {
                ["e", "E", "+", "-"].includes(evt.key) && evt.preventDefault();
            })

            initDiscount();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#short_description_input').on('input', function() {
                var maxLength = 150;
                var currentLength = $(this).val().length;
                $('#char_count').text(currentLength + '/' + maxLength);

                if (currentLength >= maxLength) {
                    alert('Deskripsi singkat sudah mencapai 150 karakter!');
                }
            });
        });
    </script>
@endsection
