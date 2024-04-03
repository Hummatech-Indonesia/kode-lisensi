@php
    use App\Helpers\ArticleHelper;
    use Carbon\Carbon;
@endphp
@extends('layouts.main')
@section('content')
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home.index') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Artikel</li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-section section-b-space">
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
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingTwo">
                                    <div class="accordion-body p-0">
                                        <div class="category-list-box">
                                            <ul>
                                                @foreach ($categories as $category)
                                                    <li>
                                                        <a
                                                            href="{{ route('home.articles.index') . '?category=' . $category->name }}">
                                                            <div class="category-name">
                                                                <h5>{{ $category->name }}</h5>
                                                                <span>{{ $category->articles_count }}</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">
                                        Artikel Terbaru
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body pt-0">
                                        <div class="recent-post-box">
                                            @foreach (ArticleHelper::topArticles() as $articles)
                                                <div class="recent-box">
                                                    <a href="{{ route('home.articles.show', $articles->slug) }}"
                                                        class="recent-image">
                                                        <img src="{{ asset('storage/' . $articles->photo) }}"
                                                            class="img-fluid blur-up lazyloaded"
                                                            alt="{{ $articles->title }}">
                                                    </a>

                                                    <div class="recent-detail">
                                                        <a href="{{ route('home.articles.show', $articles->slug) }}">
                                                            <h5 class="recent-name">{{ $articles->title }}</h5>
                                                        </a>
                                                        <h6>{{ Carbon::parse($articles->created_at)->translatedFormat('d F Y') }}
                                                        </h6>
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
                        <div class="blog-image-contain">
                            <h2>{{ $article->title }}</h2>
                            <ul class="contain-comment-list">
                                <li>
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
                    </div>

                    <div class="blog-detail-contain">
                        <div class="col-12 col-md-12">
                            <h3><span class="badge rounded-pill theme-bg-color">{{ $article->category->name }}</span></h3>
                        </div>
                        <p>
                            {!! $article->content !!}
                        </p>
                    </div>
                    <div class="comment-box overflow-hidden">
                        <div class="leave-title">
                            <h3>Tags:</h3>
                        </div>

                        <div class="row flex-row d-flex">
                            <div class="col-12">
                                @foreach (explode(',', $article->tags) as $tag)
                                    <span class="mx-2 mt-2 badge rounded-pill text-bg-dark fs-5">
                                        <h5> {{ $tag }}</h5>
                                    </span>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
