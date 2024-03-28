@extends('dashboard.layouts.app')
@section('css')
    <link href="{{ asset('dashboard_assets/css/datatables.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard_assets/css/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <h1 class="h3 mb-3">Halaman Penarikan Saldo Reseller</h1>
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endforeach
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">

        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <div class="col-12 d-flex justify-content-between">

                        <div class="">
                            <form id="search-form" class="row justify-content-end" action="" method="GET">
                                <div class="col-8"><input type="text" name="date"
                                        value="{{ date('Y-m-d') . ' - ' . date('Y-m-d') }}" class="form-control"></div>
                                <div class="col-4 d-flex flex-row">
                                    <button class="btn btn-primary me-2" type="submit">Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <table id="datatables-responsive" class="table table-striped" style="width:100%">
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
        </div>
    </div>
@endsection
@section('script')
    <x-detail-withdrawal-modal></x-detail-withdrawal-modal>

    <script src="{{ asset('dashboard_assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/daterangepicker.min.js') }}"></script>
    <script>
        $.ajax({
            type: "method",
            url: "url",
            data: "data",
            dataType: "dataType",
            success: function(response) {

            }
        });
        document.addEventListener("DOMContentLoaded", function() {



            // Datatables Responsive
            let table = $("#datatables-responsive").DataTable({
                scrollX: true,
                scrollY: '500px',
                scrollCollapse: false,
                paging: true,
                pageLength: 100,
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                ajax: "{{ route('dashboard.balance.withdrawal.history') . '?date=' . date('Y-m-d') . ' - ' . date('Y-m-d') }}",
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

            $('#search-form').submit(function(e) {
                e.preventDefault()
                const date = $('input[name="date"]').val()
                table.ajax.url("{{ route('dashboard.balance.withdrawal.history') . '?date=:date' }}"
                    .replace(
                        ':date', date))
                table.ajax.reload()

            })

            $(document).on('click', '.detail-withdrawal', function() {
                $('#detailModal').modal('show')
                const id = $(this).attr('data-id');
                const proof = $(this).attr('data-proof');
                $('#proofImage').attr('src', '/storage/' + proof);
                let url = `{{ route('balance.withdrawal.admin.update', ':id') }}`.replace(':id', id);
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
