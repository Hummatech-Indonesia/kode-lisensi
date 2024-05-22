@php
    use App\Helpers\ArticleHelper;
    use App\Helpers\UserHelper;
    use App\Helpers\CurrencyHelper;
    use Carbon\Carbon;
@endphp
@extends('layouts.main')
@section('asset')
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }

        .blog-section .blog-detail-contain p {
            color: black
        }
    </style>
@endsection
@section('content')
    <style>
        .article-content li {
            display: list-item;
        }

        .article-content ul {
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
                                <li class="breadcrumb-item" aria-current="page">Artikel</li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
                            </ol>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-section section-b-space " style="z-index: 1000;">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-3 col-xl-4 col-lg-5 d-lg-block d-none">
                    <div class="left-sidebar-box">
                        <div class="left-search-box">
                            <div class="search-box">
                                <form method="GET" action="{{ route('home.articles.index') }}">
                                    @csrf
                                    <input name="searchArticle"
                                        value="{{ request()->input('searchArticle') ?? old('searchArticle') }}"
                                        type="search" class="form-control" id="exampleFormControlInput4"
                                        placeholder="Cari Artikel..">
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
                                                                <span>({{ $category->sub_article_categories->count() }})</span>
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
                <div class="col-xxl-9 col-xl-8 col-lg-7 ratio_50">
                    <div class="blog-detail-image rounded-3 mb-4 bg-size blur-up lazyloaded">
                        <img src="{{ asset('storage/' . $article->photo) }}" class="bg-img blur-up lazyloaded"
                            alt="" style="display: none;">
                    </div>

                    <div class="blog-detail-contain">
                        <div class="col-12 col-md-12">
                            <h3><a href="{{ route('home.articles.index', $article->sub_article_category->slug) }}">
                                    <span
                                        class="badge rounded-pill theme-bg-color">{{ $article->sub_article_category->name }}</span></a>
                            </h3>
                        </div>
                        <div class="blog-image-contain">
                            <h2 class="my-3">{{ $article->title }}</h2>
                            <ul class="contain-comment-list">
                                <li style="margin-right: 1rem">
                                    <div class="user-list">
                                        <i data-feather="user"></i>
                                        <span>{{ $article->user->name }}</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="user-list">
                                        <i data-feather="calendar"></i>
                                        <span>{{ Carbon::parse($article->created_at)->translatedFormat('d F Y') }}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <p data-style="no-styling">
                        <div class="article-content">
                            {!! $article->content !!}
                        </div>
                        </p>
                    </div>
                    <div class="comment-box overflow-hidden">

                        <div class="leave-title">
                            <h3>Tags:</h3>
                        </div>

                        <div class="row flex-row d-flex">
                            <div class="col-12">
                                @foreach (explode(',', $article->tags) as $tag)
                                    <a href="{{ route('home.articles.index', ['tag' => $tag]) }}">
                                        <span class="mx-2 mt-2 badge rounded-pill text-bg-dark fs-5">
                                            <h5>{{ $tag }}</h5>
                                        </span>
                                    </a>
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#panelsStayOpen-collapseOne').collapse('show');
    });
</script>
