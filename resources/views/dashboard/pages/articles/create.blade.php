@extends('dashboard.layouts.app')
@section('content')
    <form enctype="multipart/form-data" method="POST" class="theme-form theme-form-2 mega-form"
          action="{{ route('articles.store') }}">
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
                        <h5>Detail Artikel</h5>
                        <div class="col-sm-6 mt-3">
                            <div class="alert alert-warning">
                                Catatan: <br>
                                <ul>
                                    <li>Foto Artikel harus berupa jpg,png,jpeg dengan ukuran maksimal 5Mb</li>
                                    <li>Pada input tags, gunakan koma (,) untuk memisahkan tiap tag nya</li>
                                </ul>

                            </div>
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-3 mb-0">Judul <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input value="{{ old('title') }}" autocomplete="off" name="title" class="form-control"
                                   type="text"
                                   placeholder="Hukum Menggunakan Software Bajakan">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="col-sm-3 col-form-label form-label-title">Kategori <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="article_category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-3 mb-0">Deskripsi <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input value="{{ old('description') }}" autocomplete="off" name="description"
                                   class="form-control"
                                   type="text"
                                   placeholder="Hukum menggunakan software bajakan yaitu haram.">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label
                            class="col-sm-3 col-form-label form-label-title">Thumbnail <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input name="photo" class="form-control form-choose" type="file">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-3 mb-0">Konten <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                                    <textarea class="form-control" id="content"
                                              name="content">{{ old('content') }}</textarea>
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-3 mb-0">Tags <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input value="{{ old('tags') }}" autocomplete="off" name="tags" class="form-control"
                                   type="text"
                                   placeholder="Software,Web,Artikel">
                        </div>
                    </div>

                    <div class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-3 mb-0">Status <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <label class="m-5">
                                <input {{ old('status') === '1' ? 'checked' : '' }} value="1" type="radio"
                                       name="status"> Publish
                                <input {{ old('status') === '0' ? 'checked' : '' }} value="0" type="radio"
                                       name="status"> Draft
                            </label>
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

            CKEDITOR.replace('content');

        });
    </script>
@endsection
