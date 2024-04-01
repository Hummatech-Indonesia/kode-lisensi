@extends('layouts.main')
@section('captcha')
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
@endsection
@section('content')
    <!-- log in section start -->
    <section class="log-in-section section-b-space">
        <div class="container-fluid-lg w-100">
            <div class="row">
                <div class="col-xl-12">
                    <div class="col-sm-6 mb-3">
                        @if (session('success'))
                            <x-alert-success></x-alert-success>
                        @endif
                    </div>
                </div>

                <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                    <div class="image-contain">
                        <img src="{{ asset('assets/images/inner-page/sign-up.png') }}" class="img-fluid" alt="">
                    </div>
                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                    <div class="log-in-box">
                        <div class="log-in-title">
                            <h3>Buat akun anda.</h3>
                        </div>
                        <div class="input-box">
                            <form class="row g-4" method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input value="{{ old('name') }}" autocomplete="off" type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror" id="name"
                                            placeholder="John Doe" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="email">Nama lengkap</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input value="{{ old('email') }}" autocomplete="off" type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            placeholder="Email Address" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="email">Email Address</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input name="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            placeholder="Password">
                                        <label for="password">Password</label>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input name="password_confirmation" type="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            placeholder="Password">
                                        <label for="password">Ulangi Password</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input value="{{ old('phone_number') }}" autocomplete="off" type="number" name="phone_number"
                                            class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                                            placeholder="08364729384" autofocus>
                                        @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="phone_number">Nomor HP</label>
                                    </div>
                                </div>
                                <div class="col-12 fv-row mb-10">
                                    {!! htmlFormSnippet() !!}
                                </div>

                                <div class="forgot-box mt-3">
                                    @error('g-recaptcha-response')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="forgot-box">
                                        <div class="form-check ps-0 m-0 remember-box">
                                            <input name="checkbox-term"
                                                class="checkbox_animated check-box @error('checkbox-term') is-invalid @enderror"
                                                type="checkbox" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Saya Menyetujui
                                                <a href="{{ route('home.term') }}">
                                                    <span>Syarat Dan Ketentuan</span>
                                                </a>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="forgot-box mt-3">
                                        @error('checkbox-term')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-animation w-100" type="submit">Daftar</button>
                                </div>
                            </form>
                        </div>

                        <div class="other-log-in">
                            <h6>Sudah Punya Akun?</h6>
                        </div>

                        <div class="sign-up-box">
                            <a href="{{ route('login') }}">Masuk Sekarang</a>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-7 col-xl-6 col-lg-6"></div>
            </div>
        </div>
    </section>
@endsection

<!-- mobile fix menu start -->
