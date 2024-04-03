@extends('dashboard.layouts.app')
@section('css')
    <link href="{{ asset('dashboard_assets/css/datatables.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="card card-table">
        <div class="card-body">
            <div class="col-sm-8 mt-3 mb-3">
                <div class="alert alert-danger alert-dismissible" role="alert" style="display: none;" id="validation_errors">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        <ul id="alert_message">
                        </ul>
                    </div>
                </div>
            </div>
            <div class="title-header option-title">
                <h5>Halaman Transaksi</h5>
            </div>
            <div class="table-responsive table-product">
                <table class="table theme-table" id="table_id">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Nama Customer</th>
                            <th>Tanggal Pembelian</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.34/moment-timezone-with-data.min.js"></script>
<script src="{{ asset('dashboard_assets/js/jquery.dataTables.js') }}"></script>
<script>
    $(document).ready(function() {
        moment.locale('id'); // Set bahasa ke bahasa Indonesia
        var table = $("#table_id").DataTable({
            scrollX: false,
            scrollY: '500px',
            paging: true,
            ordering: true,
            responsive: true,
            pageLength: 50,
            processing: true,
            serverSide: false,
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
                    data: 'transaction.created_at',
                    name: 'transaction.created_at',
                    render: function(data, type, row) {
                        // Menggunakan Moment.js untuk memformat tanggal dan waktu
                        return moment.tz(data, "Asia/Jakarta").format('D MMMM YYYY');
                    }
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
