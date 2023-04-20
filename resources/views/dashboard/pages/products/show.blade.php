@php use App\Enums\ProductStatusEnum;
use App\Enums\ProductTypeEnum;use App\Helpers\CurrencyHelper; @endphp
@extends('dashboard.layouts.app')
@section('css')
    <link href="{{ asset('dashboard_assets/css/datatables.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="col-sm-6 mb-3">
                @if (session('success'))
                    <x-alert-success></x-alert-success>
                @elseif(session('error'))
                    <x-alert-failed></x-alert-failed>

                @endif
            </div>
            <div class="title-header option-title">
                <h5>Produk: {{ $product->name }}</h5>
                <a class="btn btn-warning" href="{{ route('products.edit', $product) }}">Edit</a>
            </div>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button">Detail
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button">Lisensi
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-usage-tab" data-bs-toggle="pill" data-bs-target="#pills-usage"
                            type="button">Panduan
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-usage-tab" data-bs-toggle="pill" data-bs-target="#pills-usage"
                            type="button">Ulasan
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-usage-tab" data-bs-toggle="pill" data-bs-target="#pills-usage"
                            type="button">Pertanyaan
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                    <form class="theme-form theme-form-2 mega-form">
                        <div class="card-header-1"></div>

                        <div class="row">
                            <div class="col-md-3">
                                <img class="img img-fluid" src="{{ asset('storage/'. $product->photo) }}"
                                     alt="{{ $product->name }}">
                            </div>
                            <div class="col-md-9">
                                <div class="mb-4 row align-items-center">
                                    <table class="table variation-table table-responsive-sm">
                                        <thead>
                                        <tr>
                                            <th scope="col">Nama</th>
                                            <td>{{ $product->name }}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Kategori</th>
                                            <td>{{ $product->category->name }}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Harga Beli</th>
                                            <td>{{ CurrencyHelper::rupiahCurrency($product->buy_price) }}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Harga Jual</th>
                                            <td>{{ CurrencyHelper::rupiahCurrency($product->sell_price) }}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Jenis Pengguna</th>
                                            <th scope="col">Diskon</th>
                                            <th scope="col">Total Harga</th>
                                            <th scope="col"></th>
                                        </tr>
                                        <tr>
                                            <th scope="col">Customer</th>
                                            <td>
                                                {{ $product->discount . "%" }}
                                            </td>
                                            <td>
                                                {{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Reseller</th>
                                            <td>
                                                {{ $product->reseller_discount . "%" }}
                                            </td>
                                            <td>
                                                <span
                                                    id="reseller_label">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->reseller_discount, true) }}</span>
                                            </td>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="pills-profile" role="tabpanel">
                    <div class="card-header-1">
                        @if(ProductStatusEnum::AVAILABLE->value == $product->status)
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="mb-4 row align-items-center">
                                        <table class="table variation-table table-responsive-sm">
                                            <thead>
                                            <tr>
                                                <th scope="col">Stok Tersedia</th>
                                                <td id="availableStock"></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Stok Terjual</th>
                                                <td id="purchasedLicense"></td>
                                                <td></td>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        @if(ProductStatusEnum::AVAILABLE->value == $product->status)
                            <div class="mb-4 row d-flex flex-row justify-content-end">
                                <a id="btnAddLicense" data-bs-toggle="modal" data-bs-target="#addLicensesModal"
                                   style="width: 20%"
                                   class="btn btn-primary">Tambah Lisensi</a>
                            </div>
                        @else
                            <div class="mb-4 row d-flex flex-row justify-content-start">
                                <a style="width: 40%" class="btn btn-primary">Fitur Lisensi hanya tersedia pada jenis
                                    produk stocking</a>
                            </div>
                        @endif

                        @if(ProductStatusEnum::AVAILABLE->value == $product->status)
                            <div class="d-flex flex-row">
                                <button id="btnLoadData" class="btn btn-sm btn-danger m-2">Load Data</button>
                                <button id="btnUpdateData" class="btn btn-sm btn-primary m-2">Update Data</button>
                            </div>

                            <div class="table-responsive table-product mt-3">
                                <table class="table theme-table" id="table_id" style="width: 100%">
                                    <thead>
                                    <tr>
                                        @if($product->type == ProductTypeEnum::CREDENTIAL->value)
                                            <th>Username</th>
                                            <th>Password</th>
                                        @else
                                            <th>Serial Key</th>
                                        @endif
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                        @endif

                    </div>
                </div>

                <div class="tab-pane fade" id="pills-usage" role="tabpanel">
                    <form class="theme-form theme-form-2 mega-form">
                        <div class="card-header-1"></div>

                        <div class="row">
                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-lg-2 col-md-3 mb-0">Deskripsi</label>
                                <div class="col-md-9 col-lg-10">
                                    <textarea readonly id="description" cols="30"
                                              rows="10">{!! $product->description !!}</textarea>
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-lg-2 col-md-3 mb-0">Instalasi</label>
                                <div class="col-md-9 col-lg-10">
                                   <textarea readonly id="installation" cols="30"
                                             rows="10">{!! $product->installation !!}</textarea>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <label class="form-label-title col-lg-2 col-md-3 mb-0">Buku Panduan</label>
                                <div class="col-md-9 col-lg-10">
                                    <a style="width: 20%;" target="_blank"
                                       href="{{ asset('storage/' . $product->attachment_file) }}"
                                       class="btn btn-danger">Lihat File</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <x-add-licenses-modal></x-add-licenses-modal>
    </div>
@endsection

@section('script')

    <script src="{{ asset('dashboard_assets/js/jquery.dataTables.js') }}"></script>
    <script>
        $(document).ready(() => {
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            CKEDITOR.replace('description');
            CKEDITOR.replace('installation');

            const id = `{{ $product->id }}`
            const type = `{{ $product->type }}`
            const status = `{{ $product->status }}`

            $('#btnUpdateData').addClass('disabled')

            let username = null
            let password = null
            let serialKey = null
            let table = null
            let columns = null

            if (type === 'serial') {
                $('#divUsername').css('display', 'none');
                $('#divPassword').css('display', 'none');

                columns = [
                    {
                        data: 'serial_key',
                        name: 'serial_key'
                    },
                    {
                        data: 'is_purchased',
                        name: 'is_purchased'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            } else {
                $('#divSerial').css('display', 'none');
                columns = [
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'password',
                        name: 'password'
                    },
                    {
                        data: 'is_purchased',
                        name: 'is_purchased'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            }

            const updateStock = () => {

                let url = `{{ route('product.count.stocks', ':id') }}`.replace(':id', id);

                $.ajax({
                    url: url,
                    method: 'get',
                    data: {
                        _token: CSRF_TOKEN,
                    },
                    success: (data) => {
                        console.log(data)
                        $('#availableStock').text(data.data.available + " stok")
                        $('#purchasedLicense').text(data.data.purchased + " stok")
                    },
                    error: (err) => {
                        console.log(err)
                    }
                })
            }

            if (status === 'stocking') {
                $('#btnLoadData').on('click', () => {
                    table = $("#table_id").DataTable({
                        scrollX: false,
                        scrollY: '500px',
                        paging: true,
                        ordering: true,
                        responsive: true,
                        pageLength: 25,
                        processing: true,
                        serverSide: true,
                        searching: true,
                        ajax: "{{ route('licenses.index') }}",
                        columns: columns
                    });

                    $('#btnLoadData').addClass('disabled')
                    $('#btnUpdateData').removeClass('disabled')
                })

                updateStock()
            }

            $('#btnAddLicense').on('click', () => {
                password = $('#addPassword').val('')
                serialKey = $('#addSerial_key').val('')
                username = $('#addUsername').val('')
            })

            const showSweetAlert = (data) => {
                swal({
                    title: "Berhasil",
                    text: data.meta.message,
                    icon: data.meta.status,
                })
                table.ajax.reload();
            }

            $('#addLicenses').on('submit', function (e) {
                e.preventDefault();
                password = $('#addPassword').val()
                serialKey = $('#addSerial_key').val()
                username = $('#addUsername').val()

                $.ajax({
                    url: "{{ route('licenses.store') }}",
                    method: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        id: id,
                        username: username,
                        password: password,
                        serial_key: serialKey
                    },
                    success: (data) => {
                        showSweetAlert(data)
                        $('#addLicensesModal').modal('hide')
                        updateStock()
                    },
                    error: (err) => {
                        console.log(err)
                    }
                })
            });


            $('#btnUpdateData').on('click', () => {
                let array = {}

                let table = document.getElementById('table_id')
                let tbody = table.childNodes[3]
                let tr = tbody.children

                for (let i = 0; i < tr.length; i++) {
                    array[tr[i].getAttribute('id')] = {}
                    let td = tr[i].getElementsByTagName('td')
                    for (let j = 0; j < td.length; j++) {
                        if (td[j].hasChildNodes() && td[j].childNodes[0].name !== undefined) {
                            array[tr[i].getAttribute('id')][td[j].childNodes[0].name] = td[j].childNodes[0].value
                        }

                    }
                }

                $.ajax({
                    url: `{{ route('licenses.update') }}`,
                    method: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        licenses: array
                    },
                    success: (data) => {
                        showSweetAlert(data)
                    },
                    error: (err) => {
                        console.log(err)
                    }
                })
            })

            $(document).on('click', '.delete-alert', function (e) {
                e.preventDefault();
                const id = $(this).attr('data-id');
                let url = `{{ route('licenses.destroy', ':id') }}`.replace(':id', id);

                swal({
                    title: "Apa Anda Yakin?",
                    text: "Data yang dihapus tidak dapat dikembalikan",
                    icon: "warning",
                    buttons: {
                        confirm: 'Hapus',
                        cancel: 'Batal'
                    },
                    dangerMode: true,
                })
                    .then((act) => {
                        if (act) {
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                data: {
                                    _token: CSRF_TOKEN
                                },
                                success: (data) => {
                                    showSweetAlert(data)
                                    updateStock()
                                },
                                error: (err) => {
                                    console.log(err)
                                }
                            })
                        }
                    });
            });

        });

    </script>
@endsection
