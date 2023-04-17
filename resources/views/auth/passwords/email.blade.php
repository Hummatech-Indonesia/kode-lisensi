@extends('layouts.main')

@section('content')
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>link reset password akan dikirimkan pada email yang anda masukkan.</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="log-in-section section-b-space forgot-section">
        <div class="container-fluid-lg w-100">
            <div class="row">
                <div class="col-xxl-4 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                    <div class="image-contain">
                        <img src="{{ asset('assets/images/inner-page/forgot.png') }}" class="img-fluid" alt="">
                    </div>
                </div>

                <div class="col-xxl-6 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                    <div class="col-xl-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                <div class="alert-message">
                                    <strong>Sukses!</strong> Link verifikasi berhasil dikirim. Silahkan cek email anda
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="d-flex align-items-center justify-content-center h-100">

                        <div class="log-in-box">
                            <div class="log-in-title mb-5">
                                <h3>Masukkan email anda</h3>
                            </div>

                            <div class="input-box">
                                <form method="POST" class="row g-4" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <input autocomplete="off" value="{{ old('email') }}" name="email"
                                                   type="email"
                                                   class="form-control @error('email') is-invalid @enderror" id="email"
                                                   placeholder="Email Address">
                                            <label for="email">Email Address</label>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-animation w-100" type="submit">Reset Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
