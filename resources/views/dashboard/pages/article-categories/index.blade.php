@extends('dashboard.layouts.app')
@section('css')
    <link href="{{ asset('dashboard_assets/css/datatables.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
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
                    <h5>Halaman Kategori Artikel</h5>
                    <form class="d-inline-flex">
                        <a href="{{ route('article-categories.create') }}" class="align-items-center btn btn-theme d-flex">
                            <i data-feather="plus-square"></i>
                            Tambah Kategori Baru
                        </a>
                    </form>
                </div>

                <div class="table-responsive category-table">
                    <div>
                        <table class="table theme-table" id="table_id">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kategori</th>
                                    @role('admin')
                                    <th>Aksi</th>
                                    @else
                                    <th>Hubungi admin</th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        @role('admin')
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('article-categories.edit', $category->id) }}">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <form method="POST"
                                                            action="{{ route('article-categories.destroy', $category) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button class="btn text-danger delete-sweetalert" type="submit">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        </form>

                                                    </li>
                                                </ul>
                                            </td>
                                        @else
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a target="__blank" href="https://api.whatsapp.com/send/?phone=6282131536153&text=Halo%20admin%20KodeLisensi,%20saya%20mau%20order%20 ">
                                                            <button class="btn setting-button">
                                                                    <i class="ri-whatsapp-line" style="font-size: 20px"></i>
                                                            </button>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        @endrole
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script src="{{ asset('dashboard_assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/custom-data-table.js') }}"></script>
@endsection
