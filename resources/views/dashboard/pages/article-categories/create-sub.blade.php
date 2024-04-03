@extends('dashboard.layouts.app')
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-sm-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        @role('author')
                            <div class="alert alert-warning">
                                <span>Author tidak dapat mengubah atau menghapus kategori</span>
                            </div>
                        @endrole
                        <div class="card-header-2">
                            <h5>Tambah Sub Kategori {{$articleName}}</h5>
                        </div>

                        @if ($errors->any())
                            <x-validation-errors :errors="$errors"></x-validation-errors>
                        @endif

                        <form enctype="multipart/form-data" action="{{ route('sub-article-categories.store',$articleId) }}"
                            class="theme-form theme-form-2 mega-form" method="POST">
                            @csrf
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-sm-3 mb-0">Nama Kategori <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input name="name" autocomplete="off" class="form-control" type="text"
                                        placeholder="Nama Kategori">
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <div class="col-sm-6">

                                    <button class="btn btn-primary" type="submit"><i
                                            class="ri-add-line ri-1x me-2"></i>Tambah
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
