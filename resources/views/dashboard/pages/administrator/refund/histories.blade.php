@extends('dashboard.layouts.app')
@section('css')
    <link href="{{ asset('dashboard_assets/css/datatables.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="card card-table">
        <div class="col-sm-6 mb-3">
            @if (session('success'))
                <x-alert-success></x-alert-success>
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
                <h5>Riwayat Permintaan Pengajuan Dana Kembali</h5>
            </div>
            <div class="table-responsive table-product">
                <table class="table theme-table" id="table_id">
                    <thead>
                        <tr>
                            <th>Nama Pengguna</th>
                            <th>No Rekening</th>
                            <th>Nama Bank</th>
                            <th>Produk</th>
                            <th>Tanggal Penarikan</th>
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
    <x-reject-refund-modal></x-reject-refund-modal>
    <x-detail-refund-modal></x-detail-refund-modal>
    <x-approve-refund-modal></x-approve-refund-modal>

    <script src="{{ asset('dashboard_assets/js/jquery.dataTables.js') }}"></script>
    <script>
        $(document).on('click', '#approveRefund', function() {
            $('#approveRefundModal').modal('show')
            const id = $(this).attr('data-id');
            let url = `{{ route('dashboard.refund.approve', ':id') }}`.replace(':id', id);
            $('#formApprove').attr('action', url);
        });
        $(document).on('click', '#rejectRefund', function() {
            $('#rejectRefundModal').modal('show')
            console.log('test');
            const id = $(this).attr('data-id');
            let url = `{{ route('dashboard.refund.reject', ':id') }}`.replace(':id', id);
            $('#rejectRefundForm').attr('action', url);
        });
        $(document).on('click', '#detailRefund', function() {
            $('#detailRefundModal').modal('show')
            console.log('test');
            const id = $(this).attr('data-id');
            const username = $(this).data('username');
            const rekening = $(this).data('rekening');
            const bank = $(this).data('bank');
            const product = $(this).data('product');
            const created_at = $(this).data('created-at');
            const description = $(this).data('description');
            const proof = $(this).data('proof');
            console.log(username);
            console.log(rekening);
            console.log(bank);
            console.log(product);
            console.log(created_at);
            console.log(description);
            $('#username').val(username);
            $('#rekening').val(rekening);
            $('#bank').val(bank);
            $('#product').val(product);
            $('#created_at').val(created_at);
            $('#description').val(description);
            $('#proof').attr('src', '/storage/' + proof);

        });

        $.ajax({
            type: "method",
            url: "url",
            data: "data",
            dataType: "dataType",
            success: function(response) {}
        });

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
            ajax: "{{ route('dashboard.refund.histories') }}",
            columns: [{
                    data: 'user',
                    name: 'user'
                },
                {
                    data: 'rekening_number',
                    name: 'rekening_number'
                },
                {
                    data: 'bank',
                    name: 'bank'
                },
                {
                    data: 'product',
                    name: 'product'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
@endsection
