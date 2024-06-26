@php
    use Carbon\Carbon;

    use App\Helpers\CurrencyHelper;
@endphp
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
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <nav>

                        <div class="breadscrumb-contain">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home.index') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Artikel</li>
                            </ol>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>


    <section class="blog-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-4">
                <div class="col-xxl-9 col-xl-8 col-lg-7 order-lg-2">

                    @if (request()->input('searchArticle'))
                        <div class="col-12 mb-5" id="searchLabelContainer">
                            <h4 id="searchLabel">Kata Kunci Pencarian : {{ request()->input('searchArticle') }}</h4>
                        </div>
                    @elseif (request()->get('category'))
                        <div class="col-12 mb-5" id="searchLabelContainer">
                            <h4 id="searchLabel">Filter kategori : {{ request()->get('category') }}</h4>
                        </div>
                    @endif


                    <div class="row g-4">
                        @forelse($articles as $article)
                            <div class="col-12">
                                <div class="blog-box blog-list wow fadeInUp"
                                    style="visibility: visible; animation-name: fadeInUp;">
                                    <div class="blog-image">
                                        <img style="max-width: 450px; max-height: 300px"
                                            src="{{ asset('storage/' . $article->photo) }}" class="blur-up lazyloaded"
                                            alt="{{ $article->name }}">
                                    </div>

                                    <div class="blog-contain blog-contain-2">
                                        <div class="blog-label">
                                            <span class="time"><i data-feather="clock"></i>
                                                <span>{{ Carbon::parse($article->created_at)->translatedFormat('d F Y') }}</span></span>
                                            <span class="super"><i data-feather="user"></i>
                                                <span>{{ $article->user->name }}</span></span>
                                        </div>
                                        <h5 class="mt-3"><span
                                                class="badge rounded-pill theme-bg-color">{{ $article->sub_article_category->name }}</span>
                                        </h5>
                                        <a href="{{ route('home.articles.show', $article->slug) }}">
                                            <h3>{{ $article->title }}</h3>
                                        </a>
                                        <p>{{ $article->description }}</p>
                                        <a href="{{ route('home.articles.show', $article->slug) }}"
                                            class="mt-3 btn theme-bg-color btn-sm text-white fw-bold mt-md-4 mt-2 mend-auto">Baca
                                            Selengkapnya </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Data dengan filter yang dipilih tidak ditemukan</p>
                        @endforelse
                    </div>

                    <nav class="custome-pagination">
                        <ul class="pagination justify-content-center">
                            @if ($articles->currentPage() != 1)
                                <li class="page-item">
                                    @if (request()->get('searchArticle'))
                                        <a class="page-link"
                                            href="{{ $articles->previousPageUrl() . '&searchArticle=' . request()->get('searchArticle') }}"
                                            tabindex="-1">
                                            <i class="fa-solid fa-angles-left"></i>
                                        </a>
                                    @elseif(request()->get('category'))
                                        <a class="page-link"
                                            href="{{ $articles->previousPageUrl() . '&category=' . request()->get('category') }}"
                                            tabindex="-1">
                                            <i class="fa-solid fa-angles-left"></i>
                                        </a>
                                    @else
                                        <a class="page-link" href="{{ $articles->previousPageUrl() }}" tabindex="-1">
                                            <i class="fa-solid fa-angles-left"></i>
                                        </a>
                                    @endif
                                </li>
                            @endif
                            @for ($i = 0; $i < $articles->total() / $articles->perPage(); $i++)
                                <li class="page-item {{ $i + 1 == $articles->currentPage() ? 'active' : '' }}">
                                    @if (request()->get('searchArticle'))
                                        <a class="page-link"
                                            href="{{ $articles->url($i + 1) . '&searchArticle=' . request()->get('searchArticle') }}">{{ $i + 1 }}</a>
                                    @elseif(request()->get('category'))
                                        <a class="page-link"
                                            href="{{ $articles->url($i + 1) . '&category=' . request()->get('category') }}">{{ $i + 1 }}</a>
                                    @else
                                        <a class="page-link" href="{{ $articles->url($i + 1) }}">{{ $i + 1 }}</a>
                                    @endif
                                </li>
                                @if ($i == 5)
                                @break
                            @endif
                        @endfor
                        @if ($articles->currentPage() < $articles->lastPage())
                            <li class="page-item">
                                @if (request()->get('searchArticle'))
                                    <a class="page-link"
                                        href="{{ $articles->nextPageUrl() . '&searchArticle=' . request()->get('searchArticle') }}">
                                        <i class="fa-solid fa-angles-right"></i>
                                    </a>
                                @elseif(request()->get('category'))
                                    <a class="page-link"
                                        href="{{ $articles->nextPageUrl() . '&category=' . request()->get('category') }}">
                                        <i class="fa-solid fa-angles-right"></i>
                                    </a>
                                @else
                                    <a class="page-link" href="{{ $articles->nextPageUrl() }}">
                                        <i class="fa-solid fa-angles-right"></i>
                                    </a>
                                @endif

                            </li>
                        @endif

                    </ul>
                </nav>
            </div>

            <div class="col-xxl-3 col-xl-4 col-lg-5 order-lg-1">
                <div class="left-sidebar-box wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="left-search-box">
                        <div class="search-box">
                            <form method="GET" action="{{ route('home.articles.index') }}">
                                @csrf
                                <input autocomplete="off" type="search" name="searchArticle"
                                    value="{{ request()->input('searchArticle') ?? old('searchArticle') }}"
                                    class="form-control" id="exampleFormControlInput1" placeholder="Cari Artikel..">
                            </form>
                        </div>
                    </div>
                    <div class="accordion left-accordion-box" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseTwo">
                                    Kategori
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
                                aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body p-0">
                                    <div class="category-list-box">
                                        <ul>
                                            @foreach ($categories as $category)
                                                <li>
                                                    <a href="#">
                                                        <h5 style="font-weight:500;">{{ $category->name }}
                                                            <span>({{ $category->sub_article_categories_count }})</span>
                                                        </h5>
                                                    </a>
                                                    <div class="my-2">
                                                        @foreach ($category->sub_article_categories as $sub_article_category)
                                                            <a href="{{ route('home.articles.index') . '?sub_category=' . $sub_article_category->name }}"
                                                                style="margin-left: 1.5rem" href="#">
                                                                <p>{{ $sub_article_category->name }}
                                                                    <span>({{ $sub_article_category->articles->count() }})</span>
                                                                </p>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="accordion left-accordion-box" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseTwo">
                                    Produk Terbaru
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
                                aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body p-0">
                                    <div class="recent-post-box">
                                        @foreach ($products as $product)
                                            <div class="recent-box">

                                                <a href="{{ route('home.products.show', $product->slug) }}"
                                                    class="recent-image">
                                                    <img src="{{ asset('storage/' . $product->photo) }}"
                                                        class="img-fluid blur-up lazyloaded"
                                                        alt="{{ $product->name }}">
                                                </a>
                                                <div class="recent-detail">
                                                    <a href="{{ route('home.products.show', $product->slug) }}">
                                                        <h5 class="recent-name">{{ $product->name }}</h5>
                                                    </a>
                                                    <span
                                                        class="badge bg-primary text-white">{{ $product->category->name }}</span>

                                                    @if (!$product->varianProducts->isEmpty())
                                                        <h6>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::varianPrice($product->varianProducts)) }}
                                                        </h6>
                                                    @else
                                                        <h6>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}
                                                        </h6>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
