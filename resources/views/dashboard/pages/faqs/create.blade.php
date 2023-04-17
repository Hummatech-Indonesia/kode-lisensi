@extends('dashboard.layouts.app')
@section('content')
    <div class="col-sm-12">
        <!-- Details Start -->
        <div class="card">
            <div class="card-body">
                <div class="title-header option-title">
                    <h5>Tambah Bantuan</h5>
                </div>
                <div class="col-sm-4 mb-3">
                    @if (session('success'))
                        <x-alert-success></x-alert-success>
                    @endif
                </div>

                <form action="{{ route('faqs.store') }}" class="theme-form theme-form-2 mega-form"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-4 row align-items-center">
                            <label class="form-label-title col-sm-2 mb-0">Pertanyaan</label>
                            <div class="col-sm-10">
                                <input name="question" value="{{ old('question') }}" autocomplete="off"
                                       class="form-control @error('question') is-invalid @enderror"
                                       type="text"
                                       placeholder="Apakah lisensi disini legal?">
                                @error('question')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row align-items-center">
                            <label class="form-label-title col-sm-2 mb-0">Jawaban</label>
                            <div class="col-sm-10">
                                <textarea name="answer" autocomplete="off"
                                          class="form-control @error('answer') is-invalid @enderror"
                                          type="text"
                                          placeholder="Semua lisensi legal sebab kami beli langsung dari supplier besar.">{{ old('answer') }}</textarea>
                                @error('answer')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="mb-4 row align-items-center">
                            <label class="col-sm-2 col-form-label form-label-title"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-primary" type="submit" data-bs-original-title="" title=""><i
                                        class="ri-add-line ri-1x me-2"></i>Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Details End -->
    </div>
@endsection
