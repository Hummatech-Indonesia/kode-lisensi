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
                <h5>Halaman Permintaan Pengajuan Dana Kembali</h5>
            </div>
            <div class="table-responsive table-product">
                <table class="table theme-table" id="table_id">
                    <thead>
                        <tr>
                            {{-- <th>Penggunaan</th>
                            <th>Penarikan Melalui</th> --}}
                            <th>Bukti</th>
                            <th>Deskripsi</th>
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
    <x-approve-refund-modal></x-approve-refund-modal>

    <script src="{{ asset('dashboard_assets/js/jquery.dataTables.js') }}"></script>
    <script>
        $(document).on('click', '#approveRefund', function() {
            $('#approveRefundModal').modal('show')
            const id = $(this).attr('data-id');
            console.log(id);
            console.log('test');
            let url = `{{ route('dashboard.refund.approve', ':id') }}`.replace(':id', id);
            $('#formApprove').attr('action', url);
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
            ajax: "{{ route('dashboard.refund.index') }}",
            columns: [{
                    data: 'proof',
                    name: 'proof'
                },
                {
                    data: 'description',
                    name: 'description'
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
