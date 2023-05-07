@extends('dashboard.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="title-header option-title">
                <h5>Pengaturan Website</h5>
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
            <form enctype="multipart/form-data" class="theme-form theme-form-2 mega-form" method="POST"
                  action="{{ route('site-setting.update', $data) }}">
                @csrf
                @method("PATCH")
                <div class="row">
                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-2 col-form-label form-label-title"></label>
                        <div class="col-sm-10">
                            <img style="width: 20%" src="{{ asset('storage/'. $data->logo) }}" alt="">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-2 col-form-label form-label-title">Logo</label>
                        <div class="col-sm-10">
                            <input class="form-control form-choose" type="file" name="logo">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-2 mb-0">Nama Website</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="name"
                                   value="{{ $data->name }}">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-2 mb-0">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" type="text"
                                      name="description">{{ $data->description }}</textarea>
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-2 mb-0">Nomor Telepon</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="phone_number"
                                   value="{{ $data->phone_number }}">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-2 mb-0">Email</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="email" name="email" value="{{ $data->email }}">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-2 mb-0">Facebook</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="facebook" value="{{ $data->facebook }}">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-2 mb-0">Twitter</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="twitter" value="{{ $data->twitter }}">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-2 mb-0">Youtube</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="youtube" value="{{ $data->youtube }}">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-2 mb-0">Instagram</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="instagram" value="{{ $data->instagram }}">
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
