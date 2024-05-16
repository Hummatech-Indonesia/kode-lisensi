@extends('layouts.main')
@section('content')
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <div class="breadscrumb-contain">
                            {{-- <h2>Tentang {{ $site->name }}</h2> --}}
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home.index') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Tentang Kami</li>
                            </ol>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="fresh-vegetable-section section-lg-space">
        <div class="container-fluid-lg">
            <div class="row gx-xl-5 gy-xl-0 g-3 ratio_148_1">
                <div class="col-xl-6 col-12">
                    <div class="row g-sm-4 g-2">
                        <div class="col-6">
                            <div class="fresh-image-2">
                                <div class="bg-size blur-up lazyloaded">
                                    <img src="{{ asset('assets/images/inner-page/about-us/2.jpg') }}"
                                        class="bg-img blur-up lazyloaded" alt="" style="display: none;">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="fresh-image">
                                <div class="bg-size blur-up lazyloaded">
                                    <img src="{{ asset('assets/images/inner-page/about-us/1.jpg') }}"
                                        class="bg-img blur-up lazyloaded" alt="" style="display: none;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-12">
                    <div class="fresh-contain p-center-left">
                        <div>
                            <div class="review-title">
                                <h2>{{ $about->title }}</h2>
                            </div>

                            <div class="delivery-list">
                                <p class="text-content">
                                    {!! $about->content !!}
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<!-- mobile fix menu start -->
