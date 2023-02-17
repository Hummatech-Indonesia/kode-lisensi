@extends('dashboard.layouts.app')
@section('content')
    <form enctype="multipart/form-data" method="POST" class="theme-form theme-form-2 mega-form"
          action="{{ route('products.store') }}">
        @csrf
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
                            <input value="{{ old('name') }}" autocomplete="off" name="name" class="form-control"
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
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                <input min="0" autocomplete="off" name="buy_price" class="form-control" type="number"
                                       placeholder="100000">
                            </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                            <label class="form-label-title col-sm-3 mb-0">Harga Jual <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input min="0" autocomplete="off" name="sell_price" class="form-control" type="text"
                                       placeholder="250000">
                            </div>
                        </div>

                        <thead>
                        <tr>
                            <th scope="col">Jenis Pengguna</th>
                            <th scope="col">Diskon <span
                                    class="text-danger">*</span></th>
                            <th scope="col">Total Harga</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Customer</td>
                            <td>
                                <input id="discount" name="discount" value="0" class="form-control"
                                       type="number">
                            </td>
                            <td>
                                <input id="reseller_discount" name="reseller_discount"
                                       value="0" class="form-control" type="number">
                            </td>
                        </tr>
                        <tr>
                            <td>Reseller</td>
                            <td>
                                <input class="form-control" type="number" placeholder="0">
                            </td>
                            <td>
                                <input class="form-control" type="number" placeholder="0">
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
                            <select class="form-control" name="type">
                                <option>--Pilih--</option>
                                <option value="stocking-credential">Stocking - Username & Password</option>
                                <option value="stocking-serial">Stocking - Lisensi</option>
                                <option value="preoder">Preorder</option>
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
                                    <textarea class="form-control" id="editor" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <label class="form-label-title col-sm-3 mb-0">Panduan Penggunaan <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="installation"
                                              name="installation"></textarea>
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
                                Note: <br>
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
                            class="col-sm-3 col-form-label form-label-title">Foto Produk <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input name="photo" class="form-control form-choose" type="file">
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <label class="col-sm-3 col-form-label form-label-title">Berkas Panduan <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input name="attachment_file" class="form-control form-choose" type="file">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="ml-3 mb-4 row align-items-center">
                        <div class="col-sm-12">
                            <button class="btn btn-primary" type="submit"><i class="ri-add-line ri-1x me-2"></i>Tambah
                                Data
                            </button>
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

            CKEDITOR.replace('editor');
            CKEDITOR.replace('installation');

            $('#discount').on('keydown', function (evt) {
                ["e", "E", "+", "-"].includes(evt.key) && evt.preventDefault();
            })

            $('#reseller_discount').on('keydown', function (evt) {
                ["e", "E", "+", "-"].includes(evt.key) && evt.preventDefault();
            })
        });
    </script>
@endsection
