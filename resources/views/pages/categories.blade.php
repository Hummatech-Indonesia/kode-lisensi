@extends('layouts.main')
@section('content')
    <section class="container my-4">
        <div class="d-flex justify-content-center mb-4 title">
            <h2 class="">Kategori</h2>
        </div>
        <div class="row my-2">
            @foreach ($categories as $index => $category)
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="d-flex flex-column align-items-center">
                        <a href="{{ route('home.category', $category->slug) }}" class="text-decoration-none">
                            <img src="{{ asset('storage/' . $category->icon) }}" class="img-fluid my-2"
                                style="width: 64px; height: 64px;" alt="{{ $category->name }}">
                            <p class="mt-2 text-center">{{ $category->name }}</p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            <a href="{{ route('home.index') }}" class="btn btn-primary">Kembali ke halaman utama</a>
        </div>
    </section>
@endsection
