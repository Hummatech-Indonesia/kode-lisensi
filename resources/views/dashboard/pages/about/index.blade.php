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

        <div class="row">
            <form method="POST" action="{{ route('about-us.update', $about) }}">
                @method("PATCH")
                @csrf
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12 mb-5">
                                <div class="row">
                                    <label class="form-label-title col-sm-3 mb-0">Judul <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input class="form-control"
                                               name="title" value="{{ $about->title }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-5">
                                <div class="row">
                                    <label class="form-label-title col-sm-3 mb-0">Konten <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                    <textarea class="form-control" id="content"
                                              name="content">{{ $about->content }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-5">
                                <div class="row">
                                    <label class="form-label-title col-sm-3 mb-0"></label>
                                    <div class="col-sm-9">
                                        <button class="btn btn-primary" type="submit" data-bs-original-title=""
                                                title=""><i
                                                class="ri-edit-line ri-1x me-2"></i>Update
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(() => {
            CKEDITOR.replace('content');
        });
    </script>
@endsection
