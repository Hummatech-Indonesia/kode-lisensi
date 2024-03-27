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
                            <th>Nama</th>
                            <th>Saldo Ditarik</th>
                            <th>Metode Pembayaran</th>
                            <th>Nomor Rekening</th>
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
    <x-approve-withdrawal-modal></x-approve-withdrawal-modal>
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
                    url: "{{ route('balance.withdrawal.admin.index') }}",
                },
                columns: [{
                        data: 'rekening_number.name',
                        name: 'rekening_number.name',
                        orderable: false,
                    },
                    {
                        data: 'balance',
                        name: 'balance'
                    },
                    {
                        data: 'rekening_number.rekening',
                        name: 'rekening_number.rekening',
                    },
                    {
                        data: 'rekening_number.rekening_number',
                        name: 'rekening_number.rekening_number',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ]
            });

            $(document).on('click', '.approve-withdrawal', function() {
                $('#exampleModal').modal('show')
                const id = $(this).attr('data-id');
                let url = `{{ route('balance.withdrawal.admin.update', ':id') }}`.replace(':id', id);
                $('#updateForm').attr('action', url);
            });
        });
    </script>
@endsection
