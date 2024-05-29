@php
    use App\Enums\BalanceUsedEnum;
@endphp

@extends('dashboard.layouts.app')

@section('css')
    <link href="{{ asset('dashboard_assets/css/datatables.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard_assets/css/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="card card-table">
        <div class="col-sm-6 mb-3">
            @if (session('success'))
                <x-alert-success></x-alert-success>
            @elseif(session('error'))
                <x-alert-failed></x-alert-failed>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        <strong>Terjadi Kesalahan!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
        <div class="card-body">
            <div class="title-header option-title">
                <h5>Halaman Konfigurasi Slider</h5>
            </div>
            <div class="col-12 d-flex justify-content-end mb-3">
                <a href="{{ route('slider.create') }}" class="btn btn-primary">Tambah Slider</a>
            </div>


            <div class="table-responsive table-product">
                <table class="table theme-table" id="table_id">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Promo</th>
                            <th>Judul</th>
                            <th>Sub-judul</th>
                            <th>Description</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <x-delete-slider-modal></x-delete-slider-modal>
    <script src="{{ asset('dashboard_assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/daterangepicker.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let table = $("#table_id").DataTable({
                scrollX: false,
                scrollY: '500px',
                paging: true,
                ordering: true,
                responsive: true,
                pageLength: 50,
                processing: true,
                serverSide: false,
                searching: true,
                ajax: "{{ route('slider.index') }}",
                columns: [{
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'offer',
                        name: 'offer'
                    },
                    {
                        data: 'header',
                        name: 'header'
                    },
                    {
                        data: 'sub_header',
                        name: 'sub_header'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $(document).on('click', '.delete-alert', function() {
                $('#deleteSliderModal').modal('show')
                const id = $(this).attr('data-id');
                let url = `{{ route('slider.destroy', ':id') }}`.replace(':id', id);
                $('#deleteForm').attr('action', url);
            });


        });
    </script>
@endsection
