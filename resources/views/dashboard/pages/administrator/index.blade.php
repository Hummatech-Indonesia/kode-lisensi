@php
    use App\Enums\InvoiceStatusEnum;
    use App\Enums\ProductStatusEnum;
    use App\Helpers\CurrencyHelper;
@endphp
@extends('dashboard.layouts.app')
@section('css')
    <style>
        .revenues:after {
            background-color: #FFC107;
        }

        .expenditure::after {
            background-color:  rgb(225, 0, 0);
        }
    </style>
@endsection
@section('content')
    <div class="col-sm-6 col-xxl-4 col-lg-4">
        <div class="main-tiles border-5 border-0  card-hover card o-hidden">
            <div class="custome-1-bg b-r-4 card-body">
                <div class="media align-items-center static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Total Pendapatan</span>
                        <h4 class="mb-0 counter">{{ CurrencyHelper::rupiahCurrency($balance) }}
                        </h4>
                    </div>
                    <div class="align-self-center text-center">
                        <i class="ri-exchange-dollar-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xxl-4 col-lg-4">
        <div class="main-tiles border-5 border-0  card-hover card o-hidden">
            <div class="custome-1-bg b-r-4 card-body">
                <div class="media align-items-center static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Pendapatan Website</span>
                        <h4 class="mb-0 counter">{{ CurrencyHelper::rupiahCurrency($tripayBalance) }}
                        </h4>
                    </div>
                    <div class="align-self-center text-center">
                        <i class="ri-exchange-dollar-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xxl-4 col-lg-4">
        <div class="main-tiles border-5 border-0  card-hover card o-hidden">
            <div class="custome-1-bg b-r-4 card-body">
                <div class="media align-items-center static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Pendapatan Whatsapp</span>
                        <h4 class="mb-0 counter">{{ CurrencyHelper::rupiahCurrency($whatsappBalance) }}
                        </h4>
                    </div>
                    <div class="align-self-center text-center">
                        <i class="ri-exchange-dollar-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Laba --}}
    <div class="col-sm-6 col-xxl-4 col-lg-4">
        <div class="main-tiles border-5 border-0  card-hover card o-hidden">
            <div class="revenues custome-1-bg b-r-4 card-body">
                <div class="media align-items-center static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Total Laba Penjualan</span>
                        <h4 class="mb-0 counter">{{ CurrencyHelper::rupiahCurrency($revenue) }}
                        </h4>
                    </div>
                    <div class="align-self-center text-center" style="background-color: #ffc10735">
                        <i class="ri-money-dollar-circle-line" style="color: #ffc107"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xxl-4 col-lg-4">
        <div class="main-tiles border-5 border-0  card-hover card o-hidden">
            <div class="revenues custome-1-bg b-r-4 card-body">
                <div class="media align-items-center static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Laba Website</span>
                        <h4 class="mb-0 counter">{{ CurrencyHelper::rupiahCurrency($tripayRevenue) }}
                        </h4>
                    </div>
                    <div class="align-self-center text-center" style="background-color: #ffc10735">
                        <i class="ri-money-dollar-circle-line" style="color: #ffc107"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xxl-4 col-lg-4">
        <div class="main-tiles border-5 border-0  card-hover card o-hidden">
            <div class="revenues custome-1-bg b-r-4 card-body">
                <div class="media align-items-center static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Laba Whatsapp</span>
                        <h4 class="mb-0 counter">{{ CurrencyHelper::rupiahCurrency($whatsappRevenue) }}
                        </h4>
                    </div>
                    <div class="align-self-center text-center" style="background-color: #ffc10735">
                        <i class="ri-money-dollar-circle-line" style="color: #ffc107"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Pengeluaran --}}
    <div class="col-sm-6 col-xxl-4 col-lg-4">
        <div class="main-tiles border-5 border-0  card-hover card o-hidden">
            <div class="expenditure custome-1-bg b-r-4 card-body">
                <div class="media align-items-center static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Total Pengeluaran</span>
                        <h4 class="mb-0 counter">{{ CurrencyHelper::rupiahCurrency($expenditure) }}
                        </h4>
                    </div>
                    <div class="align-self-center text-center" style="background-color: rgba(213, 0, 0, 0.192)">
                        <i class="ri-money-dollar-circle-line" style="color:  rgb(225, 0, 0)"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xxl-4 col-lg-4">
        <div class="main-tiles border-5 border-0  card-hover card o-hidden">
            <div class="expenditure custome-1-bg b-r-4 card-body">
                <div class="media align-items-center static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Pengeluaran Website</span>
                        <h4 class="mb-0 counter">{{ CurrencyHelper::rupiahCurrency($tripayExpenditure) }}
                        </h4>
                    </div>
                    <div class="align-self-center text-center" style="background-color:  rgba(213, 0, 0, 0.192)">
                        <i class="ri-money-dollar-circle-line" style="color:  rgb(225, 0, 0)"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xxl-4 col-lg-4">
        <div class="main-tiles border-5 border-0  card-hover card o-hidden">
            <div class="expenditure custome-1-bg b-r-4 card-body">
                <div class="media align-items-center static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Pengeluaran Whatsapp</span>
                        <h4 class="mb-0 counter">{{ CurrencyHelper::rupiahCurrency($rekeningExpenditure) }}
                        </h4>
                    </div>
                    <div class="align-self-center text-center" style="background-color: rgba(213, 0, 0, 0.192)">
                        <i class="ri-money-dollar-circle-line" style="color: rgb(225, 0, 0)"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h3 class="fw-bold mb-3">Top 5 Pelanggan dengan Frekuensi Pembelian Tertinggi</h3>
    <table class="table variation-table table-hover table-responsive-sm">
        <thead class="bg-primary">
            <tr>
                <th>#</th>
                <th>Nama Pelanggan</th>
                <th>Jumlah Produk dibeli</th>
                {{-- <th>Total Pengeluaran</th> --}}
            </tr>
        </thead>
        @foreach ($users as $user)
            <tbody class="bg-white">
                <tr>
                    <td>{{ $user->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->transactions->count() }}</td>
                    {{-- <td>{{$user->iteration}}</td> --}}
                </tr>
            </tbody>
        @endforeach
    </table>
    </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('dashboard_assets/js/chart/apex-chart/apex-chart1.js') }}"></script>
    <script></script>
@endsection
