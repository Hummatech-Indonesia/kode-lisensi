@extends('layouts.main')
@section('captcha')
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
@endsection
@section('content')
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Kontak Kami</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home.index') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Kontak Kami</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="contact-box-section">
        <div class="container-fluid-lg">
            <div class="row g-lg-5 g-3">
                <div class="col-lg-6">
                    <div class="left-sidebar-box">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="contact-image">
                                    <img src="{{ asset('assets/images/inner-page/contact-us.png') }}"
                                         class="img-fluid blur-up lazyloaded" alt="">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="contact-title">
                                    <h3>Hubungi Kami</h3>
                                </div>

                                <div class="contact-detail">
                                    <div class="row g-4">
                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-phone"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>Phone</h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                    <p>{{ $site->phone_number }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>Email</h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                    <p>{{ $site->email }}</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="title d-xxl-none d-block">
                        <h2>Contact Us</h2>
                    </div>
                    <form method="POST" action="{{ route('home.contact.store') }}">
                        @csrf
                        <div class="right-sidebar-box">
                            <div class="row">
                                @if(session('success'))
                                    <x-alert-success></x-alert-success>
                                @endif

                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput" class="form-label">Nama depan</label>
                                        <div class="custom-input">
                                            <input autofocus value="{{ old('firstname') }}" type="text" name="firstname"
                                                   class="form-control @error('firstname') is-invalid @enderror"
                                                   autocomplete="off"
                                                   placeholder="John">
                                            <i class="fa-solid fa-user"></i>
                                            @error('firstname')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput1" class="form-label">Nama Belakang</label>
                                        <div class="custom-input">
                                            <input name="lastname" value="{{ old('lastname') }}" type="text"
                                                   class="form-control @error('lastname') is-invalid @enderror"
                                                   autocomplete="off" placeholder="Doe">
                                            <i class="fa-solid fa-user"></i>
                                            @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput2" class="form-label">Email</label>
                                        <div class="custom-input">
                                            <input autocomplete="off" type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   value="{{ old('email') }}" name="email"
                                                   placeholder="johndoe@gmail.com">
                                            <i class="fa-solid fa-envelope"></i>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput3" class="form-label">Nomor telepon</label>
                                        <div class="custom-input">
                                            <input autocomplete="off" value="{{ old('phone_number') }}"
                                                   name="phone_number"
                                                   type="number"
                                                   class="form-control @error('phone_number') is-invalid @enderror"
                                                   id="exampleFormControlInput3"
                                                   placeholder="0812648321">
                                            <i class="fa-solid fa-mobile-screen-button"></i>
                                            @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlTextarea" class="form-label">Kritik, Saran, dan
                                            Masukan</label>
                                        <div class="custom-textarea">
                                        <textarea name="message"
                                                  class="form-control @error('message') is-invalid @enderror"
                                                  placeholder="Silahkan masukan pesan anda.."
                                                  rows="6">{{ old('message') }}</textarea>
                                            <i class="fa-solid fa-message"></i>
                                            @error('message')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 fv-row mb-10">
                                    {!! htmlFormSnippet() !!}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-animation btn-md fw-bold ms-auto">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
