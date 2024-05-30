@extends('dashboard.layouts.app')
@section('content')
    <div class="col-sm-12">

        @if (session('success'))
            <x-alert-success></x-alert-success>
        @elseif($errors->any())
            <x-validation-errors :errors="$errors"></x-validation-errors>
        @endif

        <div class="title-header option-title">
            <h5>Tentang Kami</h5>
        </div>

        @if ($about)
            <div class="row">
                <form method="POST" action="{{ route('about.update', $about->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-4 row align-items-center">
                                    <label class="col-sm-3 col-form-label form-label-title"></label>
                                    <div class="col-sm-9">
                                        <img style="width: 200px;" class="img-fluid"
                                            src="{{ asset('storage/' . $about->image_1) }}" alt="{{ $about->image_1 }}">
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="col-sm-3 col-form-label form-label-title">Gambar Pertama <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input name="image_1" class="form-control" type="file">
                                    </div>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="col-sm-3 col-form-label form-label-title"></label>
                                    <div class="col-sm-9">
                                        <img style="width: 200px;" class="img-fluid"
                                            src="{{ asset('storage/' . $about->image_2) }}" alt="{{ $about->image_2 }}">
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="col-sm-3 col-form-label form-label-title">Gambar Kedua <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input name="image_2" class="form-control" type="file">
                                    </div>
                                </div>
                                <div class="col-12 mb-5">
                                    <div class="row">
                                        <label class="form-label-title col-sm-3 mb-0">Judul <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="title" value="{{ $about->title }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-5">
                                    <div class="row">
                                        <label class="form-label-title col-sm-3 mb-0">Konten <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="content" name="content">{{ $about->content }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-5">
                                    <div class="row">
                                        <label class="form-label-title col-sm-3 mb-0"></label>
                                        <div class="col-sm-9">
                                            <button class="btn btn-primary" type="submit" title=""><i
                                                    class="ri-edit-line ri-1x me-2"></i>Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @else
            <div class="row">
                <form method="POST" action="{{ route('about.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-5">
                                    <div class="row">
                                        <label class="form-label-title col-sm-3 mb-0">Gambar Pertama <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="file" name="image_1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-5">
                                    <div class="row">
                                        <label class="form-label-title col-sm-3 mb-0">Gambar Kedua <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="file" name="image_2">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-5">
                                    <div class="row">
                                        <label class="form-label-title col-sm-3 mb-0">Judul <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="title">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-5">
                                    <div class="row">
                                        <label class="form-label-title col-sm-3 mb-0">Konten <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="content" name="content"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-5">
                                    <div class="row">
                                        <label class="form-label-title col-sm-3 mb-0"></label>
                                        <div class="col-sm-9">
                                            <button class="btn btn-primary" type="submit" title=""><i
                                                    class="ri-edit-line ri-1x me-2"></i>Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endif
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(() => {
            CKEDITOR.replace('content');
        });
    </script>
@endsection
