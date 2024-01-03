@extends('dashboard.layouts.app')
@section('css')
    <link href="{{ asset('dashboard_assets/css/datatables.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard_assets/css/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <h1 class="h3 mb-3">Halaman Riwayat Transaksi</h1>

    <div class="row">
        <div class="col-sm-6 col-xxl-6 col-lg-6">
            <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                <div class="custome-1-bg b-r-4 card-body">
                    <div class="media align-items-center static-top-widget">
                        <div class="media-body p-0">
                            <span class="m-0">Total Saldo</span>
                            <h4 class="mb-0 counter" id="totalAmount"></h4>
                        </div>
                        <div class="align-self-center text-center">
                            <i class="ri-exchange-dollar-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <form id="search-form" class="row justify-content-end" action="" method="GET">
                            <div class="col-4"><input type="text" name="date"
                                    value="{{ date('Y-m-d') . ' - ' . date('Y-m-d') }}" class="form-control"></div>
                            <div class="col-2 d-flex flex-row">
                                <button class="btn btn-primary me-2" type="submit">Cari</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 mt-3">
                        <table id="datatables-responsive" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID Invoice</th>
                                    <th>Nama pengguna</th>
                                    <th>Paket dibeli</th>
                                    <th>Bayar</th>
                                    <th>Metode</th>
                                    <th>Tanggal Transaksi</th>
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
    <script src="{{ asset('dashboard_assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/daterangepicker.min.js') }}"></script>
    <script>
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
                ajax: "{{ route('orders.fetch-histories') . '?date=' . date('Y-m-d') . ' - ' . date('Y-m-d') }}",
                columns: [{
                        data: 'invoice_id',
                        name: 'invoice_id',
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'detail_transaction.product.name',
                        name: 'detail_transaction.product.name'
                    },
                    {
                        data: 'paid_amount',
                        name: 'paid_amount'
                    },
                    {
                        data: 'payment_method',
                        name: 'payment_method'
                    },

                    {
                        data: 'created_at',
                        name: 'created_at'
                    }
                ]
            });

            $('#search-form').submit(function(e) {
                e.preventDefault()
                const date = $('input[name="date"]').val()
                table.ajax.url("{{ route('revenues.index') . '?date=:date' }}".replace(':date', date))
                table.ajax.reload()

                const url = "{{ route('revenues.totalAmount') . '?date=:date' }}".replace(':date', date)
                fetchTotalAmount(url)
            })

            $('#btn-print').click(function() {
                const date = $('input[name="date"]').val()
                window.open("{{ route('revenues.print') . '?date=:date' }}".replace(':date', date),
                    '_blank')
            })

            // Daterangepicker
            $("input[name=\"date\"]").daterangepicker({
                opens: "left",
                locale: {
                    format: 'Y-M-D'
                }
            });
        });
    </script>
@endsection
