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
                <h5>Halaman Pengeluaran Administrator</h5>
            </div>
            <div class="col-12 d-flex justify-content-between mb-3">
                <div style="width: 200px">
                    <select name="" class="form-select" id="balanceUsed">
                        <option value="">Tampilkan Semua</option>
                        <option value="{{ BalanceUsedEnum::TRIPAY->value }}">Tripay</option>
                        <option value="{{ BalanceUsedEnum::REKENING->value }}">Rekening</option>
                    </select>
                </div>
                <div class="d-flex justify-content-end gap-3">
                    <form id="search-form" class="row justify-content-end" method="GET">
                        <div class="col-8">
                            <input type="text" name="date" value="{{ date('Y-m-d') }}" class="form-control">
                        </div>
                        <div class="col-4 d-flex flex-row">
                            <button class="btn btn-primary me-2" type="submit">Cari</button>
                        </div>
                    </form>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addExpenditureModal">
                        Tambah Data
                    </button>
                </div>
            </div>

            <div class="title-header option-title d-flex justify-between">
                <!-- Tambahan lainnya sesuai kebutuhan -->
            </div>
            <div class="table-responsive table-product">
                <table class="table theme-table" id="table_id">
                    <thead>
                        <tr>
                            <th>Penggunaan</th>
                            <th>Penarikan Melalui</th>
                            <th>Nominal Penarikan</th>
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
    <x-add-expenditure-modal></x-add-expenditure-modal>
    <x-delete-expenditure-modal></x-delete-expenditure-modal>
    <x-update-expenditure-modal></x-update-expenditure-modal>
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
                ajax: {
                    url: "{{ route('dashboard.fetch.expenditure') }}",
                    data: function(d) {
                        d.balanceUsed = $('#balanceUsed').val();
                    }
                },
                columns: [{
                        data: 'used_for',
                        name: 'used_for'
                    },
                    {
                        data: 'balance_used',
                        name: 'balance_used'
                    },
                    {
                        data: 'balance_withdrawn',
                        name: 'balance_withdrawn'
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

            $('#balanceUsed').on('change', function() {
                table.ajax.reload();
            });


            $(document).on('click', '.update-alert', function() {
                $('#updateExpenditureModal').modal('show')
                const id = $(this).attr('data-id');
                const usedFor = $(this).data('used-for');
                const balanceUsed = $(this).data('balance-used');
                const balanceWithdrawn = $(this).data('balance-withdrawn');
                const description = $(this).data('description');
                $('#usedFor').val(usedFor);
                $('#balanceUsed').val(balanceUsed);
                $('#balanceWithdrawn').val(balanceWithdrawn);
                $('#description').val(description);


                let url = `{{ route('dashboard.expenditure.update', ':id') }}`.replace(':id', id);
                $('#updateForm').attr('action', url);
            });
            $(document).on('click', '.delete-alert', function() {
                $('#deleteExpenditureModal').modal('show')
                const id = $(this).attr('data-id');
                let url = `{{ route('dashboard.expenditure.destroy', ':id') }}`.replace(':id', id);
                $('#deleteForm').attr('action', url);
            });
            $('#search-form').submit(function(e) {
                e.preventDefault();
                const date = $('input[name="date"]').val();
                const url = "{{ route('dashboard.fetch.expenditure') }}";

                if (date.trim() !== '') {
                    table.ajax.url(`${url}?date=${date}`).load();
                } else {
                    alert('Silakan pilih tanggal terlebih dahulu.');
                }
            });

            $("input[name=\"date\"]").daterangepicker({
                opens: "left",
                locale: {
                    format: 'Y-M-D'
                }
            });
        });
    </script>
@endsection
