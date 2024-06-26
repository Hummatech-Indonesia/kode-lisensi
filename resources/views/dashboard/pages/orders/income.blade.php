@php
    use App\Helpers\BalanceHelper;
    use App\Helpers\CurrencyHelper;
@endphp
@extends('dashboard.layouts.app')
@section('css')
    <link href="{{ asset('dashboard_assets/css/datatables.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard_assets/css/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <h1 class="h3 mb-3">Halaman Riwayat Pemasukan</h1>
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
        {{-- <div class="col-sm-6 col-xxl-6 col-lg-6">
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
        </div> --}}
        <div class="col-sm-6 col-xxl-6 col-lg-6">
            <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                <div class="custome-1-bg b-r-4 card-body">
                    <div class="media align-items-center static-top-widget">
                        <div class="media-body p-0">
                            <span class="m-0">Total Pajak Tripay Yang Dikeluarkan Pembeli</span>
                            <h4 class="mb-0 counter">{{ CurrencyHelper::rupiahCurrency(BalanceHelper::tripay_tax()) }}</h4>
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
                    <div class="col-12 d-flex justify-content-between">
                        <div style="width: 200px">
                            <select name="" class="form-select" id="orderViaWhatsapp">
                                <option value="">Tampilkan Semua</option>
                                <option value="0">Tripay</option>
                                <option value="1">Rekening</option>
                            </select>
                        </div>
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
                            <thead class="bg-primary">
                                <tr>
                                    <th>Nama pengguna</th>
                                    <th>Paket dibeli</th>
                                    <th>Metode</th>
                                    <th>Masuk Via</th>
                                    <th>Laba</th>
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

            // Datatables Responsive
            let table = $("#datatables-responsive").DataTable({
                scrollX: true,
                scrollY: '500px',
                scrollCollapse: false,
                paging: true,
                pageLength: 100,
                responsive: true,
                processing: true,
                serverSide: false,
                searching: true,
                ajax: {
                    url: "{{ route('orders.fetch-histories') . '?date=' . date('Y-m-d') . ' - ' . date('Y-m-d') }}",
                    data: function(d) {
                        d.orderViaWhatsapp = $('#orderViaWhatsapp').val();
                    }
                },
                columns: [{
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'detail_transaction.product.name',
                        name: 'detail_transaction.product.name'
                    },
                    {
                        data: 'payment_method',
                        name: 'payment_method'
                    },
                    {
                        data: 'order_via_whatsapp',
                        name: 'order_via_whatsapp'
                    },
                    {
                        data: 'revenue',
                        name: 'revenue'
                    },

                    {
                        data: 'created_at',
                        name: 'created_at'
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
            $('#orderViaWhatsapp').on('change', function() {
                table.ajax.reload();
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
@endsection
