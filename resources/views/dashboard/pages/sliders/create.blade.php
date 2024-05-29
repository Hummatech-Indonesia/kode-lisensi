@extends('dashboard.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="title-header option-title">
                <h5>Pengaturan Home Slider</h5>
            </div>
            <div class="col-sm-6 mt-3 mb-3">
                <div class="alert alert-warning">
                    Catatan: <br>
                    <ul>
                        <li>Gambar slider harus berupa jpg,png,jpeg dengan ukuran maksimal 5Mb</li>
                        <li>Tiap input dibatasi maksimal 50 karakter</li>
                    </ul>

                </div>
            </div>

            <div class="col-sm-6 mb-3">
                @if (session('success'))
                    <x-alert-success></x-alert-success>
                @elseif(session('error'))
                    <x-alert-failed></x-alert-failed>

                @endif
            </div>
            @if($errors->any())
                <x-validation-errors :errors="$errors"></x-validation-errors>
            @endif

            <div class="col-sm-12 mt-3 mb-3">
                <img class="img-fluid" src="{{ asset('slider_tutorial.png') }}" alt="">
            </div>

            <form enctype="multipart/form-data" class="theme-form theme-form-2 mega-form" method="POST"
                  action="{{ route('slider.store') }}">
                @csrf
                <div class="row">

                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-2 col-form-label form-label-title">Promo Produk <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select class="js-example-basic-single w-100" name="product_url">
                                <option value="{{ route('home.products.index') }}">Semua Produk</option>
                                @foreach($products as $product)
                                    <option
                                        {{ route('home.products.show', $product->slug) == $data->product_url ? 'selected' : '' }}
                                        value="{{ route('home.products.show', $product->slug) }}">{{ $product->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-2 mb-0">Offer <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input autocomplete="off" class="form-control" type="text" name="offer"
                                   >
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-2 mb-0">Header <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input autocomplete="off" class="form-control" type="text" name="header"
                                   >
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-2 mb-0">Sub Header <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input autocomplete="off" class="form-control" type="text" name="sub_header"
                                   >
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-2 mb-0">Deskripsi <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input autocomplete="off" class="form-control" type="text" name="description"
                                   >
                        </div>
                    </div>

                    

                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-2 col-form-label form-label-title">Background Slide</label>
                        <div class="col-sm-10">
                            <input class="form-control form-choose" type="file" name="image">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <div class="col-sm-10">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
