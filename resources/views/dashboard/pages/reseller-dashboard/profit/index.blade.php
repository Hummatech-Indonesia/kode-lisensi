@extends('dashboard.layouts.app')
@section('css')
    <link href="{{ asset('dashboard_assets/css/datatables.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="card card-table">
        <div class="card-body">
            <div class="col-sm-8 mt-3 mb-3">
                <div class="alert alert-warning">
                    Catatan: <br>
                    <ul>
                        <li>Produk yang telah dibeli oleh pengguna tidak dapat dihapus, namun dapat diarsipkan.</li>
                    </ul>
                </div>
                <div class="alert alert-danger alert-dismissible" role="alert" style="display: none;" id="validation_errors">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        <ul id="alert_message">
                        </ul>
                    </div>
                </div>
            </div>
            <div class="title-header option-title">
                <h5>Halaman Produk</h5>
            </div>
            <div class="table-responsive table-product">
                <table class="table theme-table" id="table_id">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Nama Customer</th>
                            <th>Kode Affiliate</th>
                            <th>Keuntungan</th>
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
        $(document).ready(function() {
            var table = $("#table_id").DataTable({
                scrollX: false,
                scrollY: '500px',
                paging: true,
                ordering: true,
                responsive: true,
                pageLength: 50,
                processing: true,
                serverSide: true,
                searching: true,
                ajax: {
                    url: "{{ route('dashboard.profit.transaction') }}",
                },
                columns: [{
                        data: 'product',
                        name: 'transaction.detail_transaction.product.name',
                        orderable: false,
                    },
                    {
                        data: 'customer',
                        name: 'transaction.user.name'
                    },
                    {
                        data: 'code_affiliate',
                        name: 'code_affiliate'
                    },
                    {
                        data: 'profit',
                        name: 'profit'
                    },
                ]
            });
        });
    </script>
@endsection
