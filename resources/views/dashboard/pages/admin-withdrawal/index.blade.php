@extends('dashboard.layouts.app')
@section('css')
    <link href="{{ asset('dashboard_assets/css/datatables.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <h3 class="mb-3">Permintaan penarikan saldo Reseller</h3>
    <div class="table-responsive">
        <table class="table variation-table rounded" id="withdrawal_table">
            <thead class="bg-primary">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama Reseller</th>
                    <th scope="col">No Rekening</th>
                    <th scope="col">Jumlah Penarikan</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr>
                    <td>1</td>
                    <td>Reseller</td>
                    <td>123456789</td>
                    <td>1.000.000</td>
                    <td>1-1-2024</td>
                    <td>A</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <x-delete-modal></x-delete-modal>

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
                ajax: "{{ route('product.recommendations.index') }}",
                columns: [{
                        data: 'photo',
                        name: 'photo'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row) {
                            return '<a href="{{ route('home.products.show', ':slug') }}'.replace(
                                ':slug', row.slug) + '" target="_blank">' + data + '</a>';
                        }
                    },
                    {
                        data: 'category.name',
                        name: 'category.name',
                        render: function(data, type, row) {
                            return '<a href="{{ route('home.category', ':category.id') }}'
                                .replace(':category.id', row.category.id) + '" target="_blank">' +
                                data + '</a>';
                        }
                    },
                    {
                        data: 'stock',
                        name: 'licenses_count',
                        searchable: false
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

            $(document).on('click', '.delete-product-recommendation', function() {
                $('#deleteProductRecommendationModal').modal('show')
                const id = $(this).attr('data-id');
                let url = `{{ route('product.recommendations.delete', ':id') }}`.replace(':id', id);
                $('#deleteProductRecommendation').attr('action', url);
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
