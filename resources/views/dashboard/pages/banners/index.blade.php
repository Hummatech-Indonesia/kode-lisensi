@extends('dashboard.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="title-header option-title">
                <h5>Pengaturan Home Banners</h5>
            </div>
            <div class="col-sm-6 mt-3 mb-3">
                <div class="alert alert-warning">
                    Catatan: <br>
                    <ul>
                        <li>Gambar banner harus berupa jpg,png,jpeg dengan ukuran maksimal 5Mb</li>
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
                <img class="img-fluid" src="{{ asset('banner_tutorial.png') }}" alt="">
            </div>

            <form enctype="multipart/form-data" class="theme-form theme-form-2 mega-form" method="POST"
                  action="{{ route('banners.update', $data) }}">
                @csrf
                @method("PATCH")
                <div class="row">

                    <div class="mb-4 row align-items-center">
                        <h2 class="col-sm-12">Banner 1</h2>
                    </div>


                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-2 col-form-label form-label-title">Promo Produk <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select class="js-example-basic-single w-100" name="first_product_url">
                                <option value="{{ route('home.products.index') }}">Semua Produk</option>
                                @foreach($products as $product)
                                    <option
                                        {{ route('home.products.show', $product->slug) == $data->first_product_url ? 'selected' : '' }}
                                        value="{{ route('home.products.show', $product->slug) }}">{{ $product->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-2 mb-0">Offer <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input autocomplete="off" class="form-control" type="text" name="first_offer"
                                   value="{{ $data->first_offer }}">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-2 mb-0">Title <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input autocomplete="off" class="form-control" type="text" name="first_title"
                                   value="{{ $data->first_title }}">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-2 mb-0">Deskripsi <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input autocomplete="off" class="form-control" type="text" name="first_description"
                                   value="{{ $data->first_description }}">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-2 col-form-label form-label-title"></label>
                        <div class="col-sm-10">
                            <img style="width: 20%" src="{{ asset('storage/'. $data->first_image)}}"
                                 alt="{{ $data->first_offer }}">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-2 col-form-label form-label-title">Background Slide</label>
                        <div class="col-sm-10">
                            <input class="form-control form-choose" type="file" name="first_image">
                        </div>
                    </div>


                    <div class="mb-4 row align-items-center">
                        <h2 class="col-sm-12">Banner 2</h2>
                    </div>


                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-2 col-form-label form-label-title">Promo Produk <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select class="js-example-basic-single w-100" name="second_product_url">
                                <option value="{{ route('home.products.index') }}">Semua Produk</option>
                                @foreach($products as $product)
                                    <option
                                        {{ route('home.products.show', $product->slug) == $data->second_product_url ? 'selected' : '' }}
                                        value="{{ route('home.products.show', $product->slug) }}">{{ $product->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-2 mb-0">Offer <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input autocomplete="off" class="form-control" type="text" name="second_offer"
                                   value="{{ $data->second_offer }}">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-2 mb-0">Title <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input autocomplete="off" class="form-control" type="text" name="second_title"
                                   value="{{ $data->second_title }}">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-2 mb-0">Deskripsi <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input autocomplete="off" class="form-control" type="text" name="second_description"
                                   value="{{ $data->second_description }}">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-2 col-form-label form-label-title"></label>
                        <div class="col-sm-10">
                            <img style="width: 20%" src="{{ asset('storage/'. $data->second_image)}}"
                                 alt="{{ $data->second_offer }}">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-2 col-form-label form-label-title">Background Slide</label>
                        <div class="col-sm-10">
                            <input class="form-control form-choose" type="file" name="second_image">
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
