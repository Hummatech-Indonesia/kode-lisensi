@extends('layouts.main')
@section('content')
    <section class="section-404 section-lg-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="image-404">
                        <img src="{{ asset('assets/images/inner-page/404.png') }}" class="img-fluid blur-up lazyloaded"
                             alt="">
                    </div>
                </div>

                <div class="col-12">
                    <div class="contain-404">
                        <h3 class="text-content">Halaman yang anda cari tidak ditemukan atau mungkin telah dihapus.</h3>
                        <div class="col-md-12">
                            <a href="{{ route('home.index') }}"
                               class="btn btn-md text-white theme-bg-color mt-4 mx-auto">Kembali ke Beranda
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
