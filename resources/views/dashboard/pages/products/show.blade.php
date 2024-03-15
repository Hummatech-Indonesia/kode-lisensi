@php
    use App\Enums\ProductStatusEnum;
    use App\Enums\ProductTypeEnum;
    use App\Enums\RatingStatusEnum;
    use App\Helpers\CurrencyHelper;
    use App\Helpers\RatingHelper;
    $productRatings = RatingHelper::sumProductRatings($product->id);
@endphp
@extends('dashboard.layouts.app')
@section('css')
    <link href="{{ asset('dashboard_assets/css/datatables.css') }}" rel="stylesheet" type="text/css" />
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
                <a class="btn btn-warning items-align-center" href="{{ route('products.edit', $product) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15q.4 0 .775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                    </svg> Edit</a>
            </div>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" style="font-size: 14px" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-home" type="button">Detail
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" style="font-size: 14px" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" type="button">Lisensi
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" style="font-size: 14px" id="pills-usage-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-usage" type="button">Fitur dan Panduan
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" style="font-size: 14px" id="pills-ratings-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-ratings" type="button">Ulasan
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" style="font-size: 14px" id="pills-question-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-question" type="button">Pertanyaan
                    </button>
                </li>
                @if (!$product->varianProducts->isEmpty())
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" style="font-size: 14px" id="pills-question-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-varian" type="button">Variasi Produk
                        </button>
                    </li>
                @endif
                <li class="nav-item" role="presentation">
                    <button class="nav-link" style="font-size: 14px" id="pills-question-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-email" type="button">Email
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                    <form class="theme-form theme-form-2 mega-form">
                        <div class="card-header-1"></div>

                        <div class="row">
                            <div class="col-md-3">
                                <img class="img img-fluid" src="{{ asset('storage/' . $product->photo) }}"
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
                                                <th scope="col">Deskripsi singkat</th>
                                                <td>{{ $product->short_description }}</td>
                                                <td></td>
                                            </tr>
                                            @if ($product->buy_price != 0)
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
                                            @endif

                                            <tr>
                                                <th scope="col">Jenis Pengguna</th>
                                                <th scope="col">Diskon</th>
                                                @if ($product->varianProducts->isEmpty())
                                                    <th scope="col">Total Harga</th>
                                                @endif
                                                <th scope="col"></th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Customer</th>
                                                <td>
                                                    {{ $product->discount . '%' }}
                                                </td>
                                                @if ($product->varianProducts->isEmpty())
                                                    <td>
                                                        {{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount, true) }}
                                                    </td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <th scope="col">Reseller</th>
                                                <td>
                                                    {{ $product->reseller_discount . '%' }}
                                                </td>
                                                @if ($product->varianProducts->isEmpty())
                                                    <td>
                                                        <span
                                                            id="reseller_label">{{ CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->reseller_discount, true) }}</span>
                                                    </td>
                                                @endif
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
                        @if (ProductStatusEnum::AVAILABLE->value == $product->status)
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
                        @if (ProductStatusEnum::AVAILABLE->value == $product->status)
                            <div class="mb-4 row d-flex flex-row justify-content-end">
                                <a id="btnAddLicense" data-bs-toggle="modal" data-bs-target="#addLicensesModal"
                                    style="width: 20%" class="btn btn-primary">Tambah Lisensi</a>
                            </div>
                        @else
                            <div class="mb-4 row d-flex flex-row justify-content-start">
                                <a style="width: 40%" class="btn btn-primary">Fitur Lisensi hanya tersedia pada jenis
                                    produk stocking</a>
                            </div>
                        @endif

                        @if (ProductStatusEnum::AVAILABLE->value == $product->status)
                            <div class="d-flex flex-row">
                                <button id="btnLoadData" class="btn btn-sm btn-danger m-2">Load Data</button>
                                <button id="btnUpdateData" class="btn btn-sm btn-primary m-2">Update Data</button>
                            </div>

                            <div class="table-responsive table-product mt-3">
                                <table class="table theme-table" id="table_id" style="width: 100%">
                                    <thead>
                                        <tr>
                                            @if ($product->type == ProductTypeEnum::CREDENTIAL->value)
                                                <th>Username</th>
                                                <th>Password</th>
                                            @elseif ($product->type == ProductTypeEnum::SERIAL->value)
                                                <th>Serial Key</th>
                                            @else
                                                <th>Description</th>
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
                                    <textarea readonly id="description" cols="30" rows="10">{!! $product->description !!}</textarea>
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-lg-2 col-md-3 mb-0">Fitur</label>
                                <div class="col-md-9 col-lg-10">
                                    <textarea readonly id="features" cols="30" rows="10">{!! $product->features !!}</textarea>
                                </div>
                            </div>

                            <div class="mb-4 row align-items-center">
                                <label class="form-label-title col-lg-2 col-md-3 mb-0">Instalasi</label>
                                <div class="col-md-9 col-lg-10">
                                    <textarea readonly id="installation" cols="30" rows="10">{!! $product->installation !!}</textarea>
                                </div>
                            </div>

                            {{-- <div class="row align-items-center">
                                <label class="form-label-title col-lg-2 col-md-3 mb-0">Buku Panduan</label>
                                <div class="col-md-9 col-lg-10">
                                    <a style="width: 20%;" target="_blank"
                                        href="{{ asset('storage/' . $product->attachment_file) }}"
                                        class="btn btn-danger">Lihat File</a>
                                </div>
                            </div> --}}
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="pills-ratings" role="tabpanel">
                    <form class="theme-form theme-form-2 mega-form">
                        <div class="card-header-1"></div>

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <div class="alert alert-warning">
                                    Catatan: <br>
                                    <ul>
                                        <li>Ulasan dan Rating yang ditampilkan di halaman depan hanya yang telah
                                            disetujui saja.
                                        </li>
                                    </ul>

                                </div>

                            </div>
                            <div class="col-md-9">
                                <div class="mb-4 row align-items-center">
                                    <table class="table variation-table table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Rating</th>
                                                <td>:</td>
                                                <td>
                                                    <ul class="rating">
                                                        @if ($productRatings['sumRating'] != 0)
                                                            <li class="mr-3">{{ $productRatings['sumRating'] }}</li>
                                                        @endif
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <li>
                                                                <i
                                                                    class="fas fa-star {{ $i <= $productRatings['stars'] ? 'theme-color' : '' }}"></i>
                                                            </li>
                                                        @endfor
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Jumlah</th>
                                                <td>:</td>
                                                <td>
                                                    @if (RatingHelper::countProductRatings($product->id) == 0)
                                                        Belum ada ulasan
                                                    @else
                                                        {{ RatingHelper::countProductRatings($product->id) . ' Ulasan' }}
                                                    @endif
                                                </td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>

                            </div>
                            <div class="table-responsive table-product mt-3">
                                <h3 class="mb-3">Rating Terbaru</h3>
                                <table class="table theme-table" id="table_id" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Rating</th>
                                            <th>Ulasan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse(RatingHelper::getProductRatings($product->id) as $rating)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $rating->user->name }}</td>
                                                <td>
                                                    <ul class="rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <li>
                                                                <i
                                                                    class="fas fa-star {{ $i <= $rating->rating ? 'theme-color' : '' }}"></i>
                                                            </li>
                                                        @endfor
                                                    </ul>
                                                </td>
                                                <td>{{ $rating->review }}</td>
                                                @if (RatingStatusEnum::APPROVED->value === $rating->status)
                                                    <td class="td-check">
                                                        <i class="ri-checkbox-circle-line"></i>
                                                    </td>
                                                @else
                                                    <td class="td-cross">
                                                        <i class="ri-close-circle-line"></i>
                                                    </td>
                                                @endif
                                                <td>
                                                    @if (RatingStatusEnum::APPROVED->value === $rating->status)
                                                        <a onclick="return confirm('Anda yakin ingin menolak ulasan?')"
                                                            class="btn text-danger"
                                                            href="{{ route('modify.rating', $rating->id) }}">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    @else
                                                        <a onclick="return confirm('Anda yakin ingin menampilkan ulasan?')"
                                                            class="btn text-success"
                                                            href="{{ route('modify.rating', $rating->id) }}">
                                                            <i class="ri-restart-line"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <p>Belum ada Ulasan & Rating.</p>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="pills-question" role="tabpanel">
                    <div class="card-header-1"></div>
                    <div class="row">
                        <div class="mb-4 row d-flex flex-row justify-content-end">
                            <a id="btnAddQuestion" data-bs-toggle="modal" data-bs-target="#addQuestionModal"
                                style="width: 20%" class="btn btn-primary">Tambah Pertanyaan</a>
                        </div>
                        <div class="d-flex flex-row">
                            <button id="btnLoadQuestion" class="btn btn-sm btn-danger m-2">Load Data</button>
                        </div>
                        <div class="table-responsive category-table mt-2">
                            <div>
                                <table class="table theme-table" id="product_question_id">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pertanyaan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-varian" role="tabpanel">
                    <div class="card-header-1"></div>
                    <div class="table-responsive category-striped mt-3">
                        <div class="">
                            <table class="table table-striped">
                                <thead class="bg-primary">
                                    <tr>
                                        <th scope="col">Jenis Pelanggan</th>
                                        <th scope="col">Diskon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Customer</td>
                                        <td>{{ $product->discount . '%' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Reseller</td>
                                        <td>{{ $product->reseller_discount . '%' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive category-table mt-2">
                            <div>
                                <table class="table table-striped">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Nama Varian</th>
                                            <th scope="col">Harga Beli</th>
                                            <th scope="col">Harga Jual</th>
                                            <th scope="col">Harga Customer</th>
                                            <th scope="col">Harga Reseller</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->varianProducts as $varianProduct)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $varianProduct->name }}</td>
                                                <td>{{ CurrencyHelper::rupiahCurrency($varianProduct->buy_price) }}</td>
                                                <td>{{ CurrencyHelper::rupiahCurrency($varianProduct->sell_price) }}</td>
                                                <td>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount($varianProduct->sell_price, $product->discount)) }}
                                                </td>
                                                <td>{{ CurrencyHelper::rupiahCurrency(CurrencyHelper::countPriceAfterDiscount($varianProduct->sell_price, $product->reseller_discount)) }}
                                                </td>
                                                <td>
                                                    <div class="" style="display: flex">
                                                        <a style="margin-top: 5px" id="btnEditVarian"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editVarianModal{{ $varianProduct->id }}">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                        <x-edit-varian-modal :varianProduct="$varianProduct"></x-edit-varian-modal>

                                                        <form method="POST"
                                                            action="{{ route('delete.varian.product', $varianProduct->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button class="btn text-danger delete-sweetalert"
                                                                type="submit">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-email" role="tabpanel">
                    <div class="card-header-1"></div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-sm-12 m-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-header-2">
                                            <h5>Tambah Format Email</h5>
                                        </div>

                                        @if ($errors->any())
                                            <x-validation-errors :errors="$errors"></x-validation-errors>
                                        @endif


                                        <form enctype="multipart/form-data"
                                            action="{{ route('product.email.store', $product->id) }}"
                                            class="theme-form theme-form-2 mega-form" method="POST">
                                            @csrf
                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Panduan Penggunaan<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" id="manual_book" name="manual_book">{!! $product->productEmail->manual_book ?? old('manual_book') !!}</textarea>
                                                </div>
                                            </div>
                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Note<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" id="note" name="note">{!! $product->productEmail->note ?? old('note') !!}</textarea>
                                                </div>
                                            </div>
                                            <div class="mb-4 row align-items-center">
                                                <div class="col-sm-6">

                                                    <button class="btn btn-primary" type="submit"><i
                                                            class="ri-1x me-2"></i>Simpan Data
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-add-licenses-modal></x-add-licenses-modal>
        <x-add-product-questions-modal></x-add-product-questions-modal>
        <x-edit-product-questions-modal></x-edit-product-questions-modal>
    </div>
@endsection

@section('script')
    <script src="{{ asset('dashboard_assets/js/jquery.dataTables.js') }}"></script>
    <script>
        $(document).ready(() => {
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            CKEDITOR.replace('description');
            CKEDITOR.replace('addDescription');
            CKEDITOR.replace('installation');
            CKEDITOR.replace('features');

            const id = `{{ $product->id }}`
            const type = `{{ $product->type }}`
            const status = `{{ $product->status }}`

            $('#btnUpdateData').addClass('disabled')

            let username = null
            let password = null
            let description = null
            let serialKey = null
            let table = null
            let question_table = null
            let columns = null

            if (type === 'serial') {
                $('#divDescription').css('display', 'none');
                $('#divUsername').css('display', 'none');
                $('#divPassword').css('display', 'none');

                columns = [{
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
            } else if (type === 'description') {
                $('#divSerial').css('display', 'none');
                $('#divUsername').css('display', 'none');
                $('#divPassword').css('display', 'none');

                columns = [{
                        data: 'description',
                        name: 'description'
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
                $('#divDescription').css('display', 'none');
                $('#divSerial').css('display', 'none');
                columns = [{
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
                        ajax: `{{ route('licenses.show', ':id') }}`.replace(':id', id),
                        columns: columns
                    });

                    $('#btnLoadData').addClass('disabled')
                    $('#btnUpdateData').removeClass('disabled')
                })

                updateStock()
            }

            $('#btnLoadQuestion').on('click', () => {
                question_table = $("#product_question_id").DataTable({
                    scrollX: false,
                    scrollY: '300px',
                    paging: true,
                    ordering: true,
                    responsive: true,
                    pageLength: 25,
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: "{{ route('product-questions.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'question',
                            name: 'question'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                $('#btnLoadQuestion').addClass('disabled')
            })

            $('#btnAddLicense').on('click', () => {
                password = $('#addPassword').val('')
                description = $('#addDescription').val('')
                serialKey = $('#addSerial_key').val('')
                username = $('#addUsername').val('')
            })

            const showSweetAlert = (data, table) => {
                swal({
                    title: "Berhasil",
                    text: data.meta.message,
                    icon: data.meta.status,
                })
                table.ajax.reload()
            }

            $('#addLicenses').on('submit', function(e) {
                e.preventDefault();
                password = $('#addPassword').val()
                description = $('#addDescription').val()
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
                        description: description,
                        serial_key: serialKey
                    },
                    success: (data) => {
                        $('#addLicensesModal').modal('hide')
                        showSweetAlert(data, table)
                        updateStock()
                    },
                    error: (err) => {
                        $('#addLicensesModal').modal('hide')
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
                            array[tr[i].getAttribute('id')][td[j].childNodes[0].name] = td[j].childNodes[0]
                                .value
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
                        showSweetAlert(data, table)
                    },
                    error: (err) => {
                        console.log(err)
                    }
                })
            })

            const handleDelete = (url, table) => {
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
                                    showSweetAlert(data, table)
                                    updateStock()
                                },
                                error: (err) => {
                                    console.log(err)
                                }
                            })
                        }
                    });
            }

            $(document).on('click', '.delete-alert', function(e) {
                e.preventDefault();
                const id = $(this).attr('data-id');
                let url = `{{ route('licenses.destroy', ':id') }}`.replace(':id', id);

                handleDelete(url, table)
            });

            $(document).on('click', '.delete-question', function(e) {
                e.preventDefault();
                const id = $(this).attr('data-id');
                let url = `{{ route('product-questions.destroy', ':id') }}`.replace(':id', id);

                handleDelete(url, question_table)
            });

            $('#btnAddQuestion').on('click', function() {
                $('#addQuestion').val('')
                $('#addAnswer').val('')
            })

            $('#addQuestions').on('submit', function(e) {
                e.preventDefault();
                const question = $('#addQuestion').val()
                const answer = $('#addAnswer').val()

                $.ajax({
                    url: "{{ route('product-questions.store') }}",
                    method: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        product_id: id,
                        question: question,
                        answer: answer
                    },
                    success: (data) => {
                        $('#addQuestionModal').modal('hide')
                        showSweetAlert(data, question_table)

                    },
                    error: (err) => {
                        $('#addQuestionModal').modal('hide')
                        let errors = err.responseJSON.errors
                        console.log(errors)
                        swal({
                            icon: 'error',
                            title: "Terjadi Kesalahan!",
                            text: (errors.question) ? errors.question[0] : errors
                                .answer[0],
                        })
                    }
                })
            });

            $(document).on('click', '.edit-question', function() {
                const question = $(this).attr('data-question')
                const answer = $(this).attr('data-answer')
                const question_id = $(this).attr('data-id')

                $('#editQuestion').val(question)
                $('#editAnswer').val(answer)
                $('#editQuestionId').val(question_id)
            })

            $('#editQuestions').on('submit', function(e) {
                e.preventDefault();
                const question = $('#editQuestion').val()
                const answer = $('#editAnswer').val()
                const question_id = $('#editQuestionId').val()
                let url = `{{ route('product-questions.update', ':id') }}`.replace(':id', question_id);

                console.log(question, answer, question_id)

                $.ajax({
                    url: url,
                    type: "PATCH",
                    data: {
                        _token: CSRF_TOKEN,
                        product_id: id,
                        question: question,
                        answer: answer
                    },
                    success: (data) => {
                        showSweetAlert(data, question_table)
                        $('#editQuestionModal').modal('hide')

                    },
                    error: (err) => {
                        let errors = err.responseJSON.errors
                        console.log(errors)
                        swal({
                            icon: 'error',
                            title: "Terjadi Kesalahan!",
                            text: (errors.question) ? errors.question[0] : errors
                                .answer[0],
                        })
                    }
                })
            })

        })
        $(document).ready(() => {
            CKEDITOR.replace('editor');
            CKEDITOR.replace('installation');
            CKEDITOR.replace('features');
            CKEDITOR.replace('manual_book');
            CKEDITOR.replace('note');
        });
    </script>
@endsection
