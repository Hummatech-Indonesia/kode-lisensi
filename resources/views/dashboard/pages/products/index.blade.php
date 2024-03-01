@extends('dashboard.layouts.app')
@section('css')
    <link href="{{ asset('dashboard_assets/css/datatables.css') }}" rel="stylesheet" type="text/css" />
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
            <div class="col-sm-8 mt-3 mb-3">
                <div class="alert alert-warning">
                    Catatan: <br>
                    <ul>
                        <li>- Produk yang telah dibeli oleh pengguna tidak dapat dihapus, namun dapat diarsipkan.</li>
                    </ul>

                </div>
            </div>
            <div class="title-header option-title">
                <h5>Halaman Produk</h5>
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
    <x-delete-modal></x-delete-modal>
    <x-soft-delete-modal></x-soft-delete-modal>

    <script src="{{ asset('dashboard_assets/js/jquery.dataTables.js') }}"></script>
    <script>
        $(document).ready(function() {
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
                columns: [{
                        data: 'photo',
                        name: 'photo'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'category.name',
                        name: 'category.name'
                    },
                    {
                        data: 'stock',
                        name: 'licenses_count',
                        searchable: false
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
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $(document).on('click', '.delete-alert', function() {
                $('#exampleModal').modal('show')
                const id = $(this).attr('data-id');
                let url = `{{ route('product.destroy', ':id') }}`.replace(':id', id);
                $('#deleteForm').attr('action', url);
            });

            $(document).on('click', '.delete-soft', function() {
                $('#softModal').modal('show')
                const id = $(this).attr('data-id');
                let url = `{{ route('product.soft.delete', ':id') }}`.replace(':id', id);
                $('#deleteSoft').attr('action', url);
            });

        });
    </script>
@endsection
