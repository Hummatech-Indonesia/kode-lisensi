@extends('dashboard.layouts.app')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-sm-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Ubah Data Kategori</h5>
                        </div>

                        @if($errors->any())
                            <x-validation-errors :errors="$errors"></x-validation-errors>
                        @endif

                        <form enctype="multipart/form-data" action="{{ route('categories.update', $category) }}"
                              class="theme-form theme-form-2 mega-form" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Nama Kategori <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input value="{{ $category->name }}" name="name" autocomplete="off"
                                           class="form-control" type="text"
                                           placeholder="Nama Kategori">
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <div class="col-sm-3 form-label-title"></div>
                                <div class="col-sm-9">
                                    <img width="100px" src="{{ asset('storage/' . $category->icon) }}" alt="">
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <div class="col-sm-3 form-label-title">Icon Kategori</div>
                                <div class="col-sm-9">
                                    <input name="icon" class="form-control" type="file">
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <div class="col-sm-6">

                                    <button class="btn btn-primary" type="submit"><i
                                            class="ri-edit-line ri-1x me-2"></i>Ubah
                                        Data
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
