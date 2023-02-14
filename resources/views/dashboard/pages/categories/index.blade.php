@extends('dashboard.layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/datatables.css') }}">
@endsection
@section('content')
    <div class="card card-table">
        <div class="card-body">
            <div class="col-sm-6 mb-3">
                @if (session('success'))
                    <x-alert-success></x-alert-success>
                @elseif(session('error'))
                    <x-alert-failed></x-alert-failed>

                @endif
            </div>
            <div class="title-header option-title">
                <h5>Halaman Kategori</h5>
                <form class="d-inline-flex">
                    <a href="{{ route('categories.create') }}"
                       class="align-items-center btn btn-theme d-flex">
                        <i data-feather="plus-square"></i>Tambah Kategori Baru
                    </a>
                </form>
            </div>

            <div class="table-responsive category-table">
                <div>
                    <table class="table theme-table" id="table_id">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Icon</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img width="100px" src="{{ asset('storage/' . $category->icon) }}"
                                         alt="{{ $category->name }}">
                                </td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <ul>
                                        <li>
                                            <a href="{{ route('categories.edit', $category->id) }}">
                                                <i class="ri-pencil-line"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <form method="POST" action="{{ route('categories.destroy', $category) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn text-danger" type="submit"
                                                        onclick="return confirm('Yakin ingin menghapus data?')">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>

                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('dashboard_assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/custom-data-table.js') }}"></script>
@endsection
