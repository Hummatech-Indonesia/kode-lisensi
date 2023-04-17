@extends('layouts.main')
@section('content')
    <section class="faq-breadscrumb pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Frequently Asked Question</h2>
                        <p>Beberapa pertanyaan umum penggunaan aplikasi {{ config('app.name') }}.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="faq-box-contain section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="faq-accordion">
                        <div class="accordion" id="accordionExample">
                            @foreach($helps as $help)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="false"
                                                aria-controls="collapseOne">
                                            {{ $help->question }} <i
                                                class="fa-solid fa-angle-down"></i>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse"
                                         aria-labelledby="headingOne"
                                         data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <p>{{ $help->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<!-- mobile fix menu start -->
