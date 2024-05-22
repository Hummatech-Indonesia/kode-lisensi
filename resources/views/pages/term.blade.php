@extends('layouts.main')

@section('content')
    <style>
        .faq-box-contain li {
            display: list-item;
        }

        .faq-box-contain ul {
            padding-left: 40px;
        }
    </style>
    <section class="faq-breadscrumb pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Syarat dan Ketentuan</h2>
                        <p>Beberapa syarat dan ketentuan penggunaan website {{ $site->name }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="faq-box-contain section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-12">
                    <div class="fresh-contain p-center-left">
                        <div>
                            <div class="delivery-list">
                                <p class="text-content">{!! $term->term !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<!-- mobile fix menu start -->
