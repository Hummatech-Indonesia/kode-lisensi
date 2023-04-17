@extends('layouts.main')

@section('content')

    <section class="log-in-section section-b-space forgot-section">
        <div class="container-fluid-lg w-100">
            <div class="row">

                <div class="col-xxl-12 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                    <div class="col-xl-12">
                        @if(session('status'))
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
                                <h3>Reset Password</h3>
                            </div>

                            <div class="input-box">
                                <form method="POST" class="row g-4" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email" value="{{ $email ?? old('email') }}" required
                                                   autocomplete="email" autofocus>
                                            <label for="email">Email Address</label>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" required autocomplete="new-password">
                                            <label for="email">Password</label>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating theme-form-floating log-in-form">
                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" required autocomplete="new-password">
                                            <label for="email">Konfirmasi Password</label>
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
