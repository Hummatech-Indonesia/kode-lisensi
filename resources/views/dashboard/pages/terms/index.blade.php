@extends('dashboard.layouts.app')
@section('content')
    <div class="col-sm-12">

        @if (session('success'))
            <x-alert-success></x-alert-success>
        @elseif($errors->any())
            <x-validation-errors :errors="$errors"></x-validation-errors>
        @endif

        <div class="title-header option-title">
            <h5>Syarat dan Ketentuan</h5>
        </div>

        <div class="row">
            <form method="POST" action="{{ route('term-privacy.update', $termPrivacy->id) }}">
                @method("PATCH")
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="card-header-2">
                            <h5>Deskripsi</h5>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-5">
                                <div class="row">
                                    <label class="form-label-title col-sm-3 mb-0">Syarat dan Ketentuan <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                    <textarea class="form-control" id="term"
                                              name="term">{{ $termPrivacy->term }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <label class="form-label-title col-sm-3 mb-0">Kebijakan Penggunaan <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                    <textarea class="form-control" id="privacy"
                                              name="privacy">{{ $termPrivacy->privacy }}</textarea>
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

            CKEDITOR.replace('term');
            CKEDITOR.replace('privacy');

        });
    </script>
@endsection
