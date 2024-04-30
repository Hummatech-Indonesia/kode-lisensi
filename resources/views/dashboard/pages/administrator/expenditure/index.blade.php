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
                <div class="">
                    <form id="search-form" class="row justify-content-end" action="" method="GET">
                        <div class="col-8"><input type="text" name="date"
                                value="{{ date('Y-m-d') . ' - ' . date('Y-m-d') }}" class="form-control"></div>
                        <div class="col-4 d-flex flex-row">
                            <button class="btn btn-primary me-2" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addExpenditureModal">
                    Tambah Data
                </button>
            </div>


            <div class="title-header option-title d-flex justify-between">

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
    <x-update-expenditure-modal></x-delete-expenditure-modal>
    <x-update-expenditure-modal></x-update-expenditure-modal>
    <script src="{{ asset('dashboard_assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/daterangepicker.min.js') }}"></script>
    <script>
        $.ajax({
            type: "method",
            url: "url",
            data: "data",
            dataType: "dataType",
            success: function(response) {}
        });

        document.addEventListener("DOMContentLoaded", function() {
            const firstUrl =
                `{{ route('revenues.totalAmount') . '?date=' . date('Y-m-d') . ' - ' . date('Y-m-d') }}`;

            const fetchTotalAmount = (url) => {
                $.ajax({
                    url: url,
                    method: 'get',
                    success: (data) => {
                        document.getElementById('totalAmount').innerHTML = data
                        console.log(data)
                    },
                    error: (err) => {
                        console.log(err)
                    }
                })
            }

            fetchTotalAmount(firstUrl)

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
                ajax: "{{ route('dashboard.fetch.expenditure') . '?date=' . date('Y-m-d') . ' - ' . date('Y-m-d') }}",
                columns: [{
                        data: 'used_for',
                        name: 'used_for',
                        render: function(data, type, row) {
                            if (data === 'buy_product') {
                                return 'Beli Produk';
                            } else if (data === 'pay_reseller') {
                                return 'Bayar Reseller';
                            } else if (data === 'others') {
                                return 'Lainnya';
                            } else {
                                return data; // fallback to original value if not matched
                            }
                        }
                    },
                    {
                        data: 'balance_used',
                        name: 'balance_used',
                    },
                    {
                        data: 'balance_withdrawn',
                        name: 'balance_withdrawn',
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

            $('.dataTables_scrollBody').css({
                'position': 'relative',
                'overflow': 'auto',
                'max-height': 'none',
                'height': 'max-content',
                'width': '100%'
            });

            $('#search-form').submit(function(e) {
                e.preventDefault()
                const date = $('input[name="date"]').val()
                table.ajax.url("{{ route('revenues.index') . '?date=:date' }}".replace(':date', date))
                table.ajax.reload()

                const url = "{{ route('revenues.totalAmount') . '?date=:date' }}".replace(':date', date)
                fetchTotalAmount(url)
            })
            $(document).on('click', '.delete-alert', function() {
                $('#deleteExpeneditureModal').modal('show')
                const id = $(this).attr('data-id');
                let url = `{{ route('dashboard.expenditure.destroy', ':id') }}`.replace(':id', id);
                $('#deleteForm').attr('action', url);
            });
            $(document).on('click', '.update-alert', function() {
                $('#updateExpenditureModal').modal('show')
                const id = $(this).data('id');
                const usedFor = $(this).data('used-for');
                const balanceUsed = $(this).data('balance-used');
                const balanceWithdrawn = $(this).data('balance-withdrawn');
                const description = $(this).data('description');
                $('#usedFor').val(usedFor)
                $('#balanceUsed').val(balanceUsed)
                $('#balanceWithdrawn').val(balanceWithdrawn)
                $('#description').val(description)
                let url = `{{ route('dashboard.expenditure.update', ':id') }}`.replace(':id', id);
                $('#updateForm').attr('action', url);
            });

            // Daterangepicker
            $("input[name=\"date\"]").daterangepicker({
                opens: "left",
                locale: {
                    format: 'Y-M-D'
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
@endsection
