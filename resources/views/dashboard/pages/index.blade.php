@php
    use App\Enums\InvoiceStatusEnum;
    use App\Enums\ProductStatusEnum;
    use App\Helpers\CurrencyHelper;
@endphp
@extends('dashboard.layouts.app')
@section('content')
    <div class="col-sm-6 col-xxl-4 col-lg-6">
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

    <div class="col-sm-6 col-xxl-4 col-lg-6">
        <div class="main-tiles border-5 card-hover border-0 card o-hidden">
            <div class="custome-2-bg b-r-4 card-body">
                <div class="media static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Total produk terjual</span>
                        <h4 class="mb-0 counter">
                            {{ $order }}
                        </h4>
                    </div>
                    <div class="align-self-center text-center">
                        <i class="ri-shopping-bag-3-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xxl-4 col-lg-6">
        <div class="main-tiles border-5 card-hover border-0  card o-hidden">
            <div class="custome-3-bg b-r-4 card-body">
                <div class="media static-top-widget">
                    <div class="media-body p-0">
                        <span class="m-0">Total Pengguna</span>
                        <h4 class="mb-0 counter">{{ $customer }}
                        </h4>
                    </div>

                    <div class="align-self-center text-center">
                        <i class="ri-user-add-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Best Selling Product Start -->
    <div class="col-xl-12 col-md-12">
        <div class="card o-hidden card-hover">
            <div class="card-header card-header-top card-header--2 px-0 pt-0">
                <div class="card-header-title">
                    <h4>5 Produk Terlaris</h4>
                </div>
            </div>

            <div class="card-body p-0">
                <div>
                    <div class="table-responsive">
                        <table class="user-table ticket-table review-table theme-table table dataTable no-footer"
                            id="table_id">
                            <thead>
                                <tr>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 150px;">#
                                    </th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 150px;">Nama
                                    </th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 150px;">
                                        Kategori
                                    </th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 150px;">Jenis
                                    </th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 150px;">Terjual
                                    </th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 150px;">Total
                                        Pendapatan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bestSeller as $seller)
                                    <tr>
                                        <td>
                                            <img width="150px" src="{{ asset('storage/' . $seller->photo) }}"
                                                alt="{{ $seller->name }}">
                                        </td>
                                        <td><a href="{{ route('home.products.show', $seller->slug) }}"
                                                class="text-dark">{{ $seller->name }}</a></td>
                                        <td>{{ $seller->category->name }}</td>
                                        <td>
                                            @if ($seller->status === ProductStatusEnum::PREORDER->value)
                                                <span class="badge badge-danger">Preorder</span>
                                            @else
                                                <span class="badge badge-success">Stocking</span>
                                            @endif
                                        </td>
                                        <td>{{ $seller->transactions_count }}</td>
                                        <td>{{ CurrencyHelper::rupiahCurrency($seller->total) }}</td>
                                    </tr>
                                @empty
                                    <p>Belum ada Produk.</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Best Selling Product End -->

    <!-- Best Selling Product Start -->
    <div class="col-xl-8 col-md-12">
        <div class="card o-hidden card-hover">
            <div class="card-header card-header-top card-header--2 px-0 pt-0">
                <div class="card-header-title">
                    <h4>Produk dengan stok akan habis</h4>
                </div>
            </div>

            <div class="card-body p-0">
                <div>
                    <div class="table-responsive">
                        <div id="table_id_wrapper" class="dataTables_wrapper no-footer">
                            <table class="user-table ticket-table review-table theme-table table dataTable no-footer"
                                id="table_id" style="display: block; overflow-y: scroll; max-height: 300px">
                                <thead>
                                    <tr>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 150px;">
                                            Nama
                                            Produk
                                        </th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 150px;">
                                            Sisa Stok
                                        </th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 150px;">
                                            Tambah
                                            Stok
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($lowStockProduct as $products)
                                        <tr>
                                            <td><a href="{{ route('home.products.show', $products->slug) }}"
                                                    class="text-dark">{{ $products->name }}</a></td>
                                            <td>
                                                @if ($products->licenses_count > 0)
                                                    <span class="badge badge-success">Tersisa
                                                        {{ $products->licenses_count }}</span>
                                                @else
                                                    <span class="badge badge-danger">Habis</span>
                                                @endif
                                            </td>
                                            <td width="10%">
                                                <a class="text-primary"
                                                    href="{{ route('products.show', $products->id) }}"><i
                                                        class="ri-add-line"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <p>Belum ada Produk.</p>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Best Selling Product End -->

    <!-- visitors chart start-->
    <div class="col-xxl-4 col-md-6">
        <div class="h-100">
            <div class="card o-hidden card-hover">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="card-header-title">
                            <h4>Produk Terdaftar : {{ $product }}</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="pie-chart">
                        <div id="pie-chart-visitors"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- visitors chart end-->

    <!-- Earning chart star-->
    <div class="col-xl-12">
        <div class="card o-hidden card-hover">
            <div class="card-header border-0 pb-1">
                <div class="card-header-title">
                    <h4>Statistik Laporan pendapatan per bulan</h4>
                </div>
            </div>
            <div class="card-body p-0">
                <div id="report-chart"></div>
            </div>
        </div>
    </div>
    <!-- Earning chart  end-->

    <!-- Recent orders start-->
    <div class="col-xl-12 col-md-12">
        <div class="card o-hidden card-hover">
            <div class="card-header card-header-top card-header--2 px-0 pt-0">
                <div class="card-header-title">
                    <h4>Transaksi Terbaru</h4>
                </div>

            </div>

            <div class="card-body p-0">
                <div>
                    <div class="table-responsive">
                        <div id="table_id_wrapper" class="dataTables_wrapper no-footer">
                            <table class="user-table ticket-table review-table theme-table table dataTable no-footer"
                                id="table_id">
                                <thead>
                                    <tr>
                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                            style="width: 150px;">ID
                                            Invoice
                                        </th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                            style="width: 150px;">Pelanggan
                                        </th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                            style="width: 150px;">Produk
                                            dibeli
                                        </th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                            style="width: 150px;">Total
                                            Tagihan
                                        </th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1"
                                            style="width: 150px;">Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($latestTransaction as $transaction)
                                        <tr>
                                            <td>{{ $transaction->invoice_id }}</td>
                                            <td>{{ $transaction->user->name }}</td>
                                            <td><a href="{{ route('home.products.show', $transaction->detail_transaction->product->slug) }}"
                                                    class="text-dark">{{ $transaction->detail_transaction->product->name }}</a>
                                            </td>
                                            <td>{{ CurrencyHelper::rupiahCurrency($transaction->amount) }}</td>
                                            <td>
                                                @if (InvoiceStatusEnum::PAID->value === $transaction->invoice_status ||
                                                        InvoiceStatusEnum::SETTLED->value === $transaction->invoice_status)
                                                    <span class="badge badge-success">LUNAS</span>
                                                @elseif(InvoiceStatusEnum::EXPIRED->value === $transaction->invoice_status ||
                                                        InvoiceStatusEnum::FAILED->value === $transaction->invoice_status)
                                                    <span class="badge badge-danger">EXPIRED</span>
                                                @else
                                                    <span class="badge badge-warning">PENDING</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <p>Belum ada Produk.</p>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Recent orders end-->
@endsection
@section('script')
    <script src="{{ asset('dashboard_assets/js/chart/apex-chart/apex-chart1.js') }}"></script>
    <script>
        $(document).ready(() => {

            //pie chart
            const PieChart = () => {
                let options = {
                    chart: {
                        height: 350,
                        type: "pie",
                    },
                    dataLabels: {
                        enabled: true
                    },
                    labels: {!! json_encode($pieChart['labels']) !!},
                    series: {!! json_encode($pieChart['series']) !!}
                };

                let chart = new ApexCharts(document.querySelector("#pie-chart-visitors"), options);
                chart.render();
            }

            const lineChart = () => {
                let options = {
                    series: [{
                        name: 'Total Pendapatan',
                        data: {!! json_encode($lineChart['series']) !!}
                    }],
                    chart: {
                        height: 320,
                        type: 'area',
                        dropShadow: {
                            enabled: true,
                            top: 10,
                            left: 0,
                            blur: 3,
                            color: '#720f1e',
                            opacity: 0.15
                        },
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        },
                    },
                    markers: {
                        strokeWidth: 4,
                        strokeColors: "#ffffff",
                        hover: {
                            size: 9,
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth',
                        lineCap: 'butt',
                        width: 4,
                    },
                    legend: {
                        show: false
                    },
                    colors: ["#0da487"],
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.7,
                            opacityTo: 0.6,
                            stops: [0, 90, 100]
                        }
                    },
                    grid: {
                        xaxis: {
                            lines: {
                                borderColor: 'transparent',
                                show: true
                            }
                        },
                        yaxis: {
                            lines: {
                                borderColor: 'transparent',
                                show: false,
                            }

                        },
                        padding: {
                            right: -112,
                            bottom: 0,
                            left: 15
                        }
                    },
                    responsive: [{
                            breakpoint: 1200,
                            options: {
                                grid: {
                                    padding: {
                                        right: -95,
                                    }
                                },
                            },
                        },
                        {
                            breakpoint: 992,
                            options: {
                                grid: {
                                    padding: {
                                        right: -69,
                                    }
                                },
                            },
                        },
                        {
                            breakpoint: 767,
                            options: {
                                chart: {
                                    height: 200,
                                }
                            },
                        },
                        {
                            breakpoint: 576,
                            options: {
                                yaxis: {
                                    labels: {
                                        show: false,
                                    },
                                },
                            },
                        }
                    ],
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return "Rp " + value;
                            }
                        },
                        crosshairs: {
                            show: true,
                            position: 'back',
                            stroke: {
                                color: '#b6b6b6',
                                width: 1,
                                dashArray: 5,
                            },
                        },
                        tooltip: {
                            enabled: true,
                        },
                    },
                    xaxis: {
                        categories: {!! json_encode($lineChart['labels']) !!},
                        range: undefined,
                        axisBorder: {
                            low: 0,
                            offsetX: 0,
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                    },
                };

                let chart = new ApexCharts(document.querySelector("#report-chart"), options);
                chart.render();
            }

            PieChart()
            lineChart()

        })
    </script>
@endsection
