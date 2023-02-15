@extends('dashboard.layouts.app')
@section('css')
    <link href="{{ asset('dashboard_assets/css/datatables.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="card card-table">
        <div class="card-body">
            <div class="title-header option-title">
                <h5>Halaman Produk</h5>
                <div class="right-options">
                    <ul>
                        <li>
                            <a class="btn btn-solid" href="{{ route('products.create') }}"><i
                                    class="ri-add-line ri-1x me-2"></i>Tambah
                                produk baru</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="table-responsive table-product">
                <table class="table theme-table" id="table_id">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Status</th>
                        <th>Tipe</th>
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
    <script src="{{ asset('dashboard_assets/js/jquery.dataTables.js') }}"></script>
    <script>
        $(document).ready(function () {


            // Datatables Responsive
            $("#table_id").DataTable({
                scrollX: false,
                scrollY: '500px',
                paging: true,
                ordering: true,
                responsive: true,
                pageLength: 50,
                processing: true,
                serverSide: true,
                searching: true,
                ajax: "{{ route('products.index') }}",
                columns: [
                    {
                        data: 'photo',
                        name: 'photo'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'buy_price',
                        name: 'buy_price'
                    },
                    {
                        data: 'sell_price',
                        name: 'sell_price'
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endsection
