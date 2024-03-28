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
            <div class="title-header option-title">
                <h5>Halaman Produk</h5>
            </div>

            <div class="table-responsive table-product">
                <table class="table theme-table" id="table_id">
                    <thead>
                        <tr>
                            <th>Metode Penarikan</th>
                            <th>Saldo Ditarik</th>
                            <th>Tanggal Penarikan</th>
                            <th>Status</th>
                            <th>Detail</th>
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
    <x-detail-withdrawal-modal></x-detail-withdrawal-modal>
    <script src="{{ asset('dashboard_assets/js/jquery.dataTables.js') }}"></script>
    <script>
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

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
                    url: "{{ route('dashboard.balance.withdrawal.history') }}",
                },
                columns: [{
                        data: 'rekening_number_id',
                        name: 'rekening_number_id'
                    },
                    {
                        data: 'balance',
                        name: 'balance'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'detail',
                        name: 'detail',
                        searchable: false,
                        orderable: false,
                    },
                ]
            });
        });
        $(document).on('click', '.detail-withdrawal', function() {
            $('#detailModal').modal('show')
            const id = $(this).attr('data-id');
            const proof = $(this).attr('data-proof');
            $('#proofImage').attr('src', '/storage/' + proof);
            let url = `{{ route('balance.withdrawal.admin.update', ':id') }}`.replace(':id', id);
            $('#updateForm').attr('action', url);
        });
    </script>
@endsection
