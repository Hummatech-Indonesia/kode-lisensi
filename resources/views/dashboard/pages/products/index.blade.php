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
            <div class="col-sm-8 mt-3 mb-3">
                <div class="alert alert-warning">
                    Catatan: <br>
                    <ul>
                        <li>Produk yang telah dibeli oleh pengguna tidak dapat dihapus, namun dapat diarsipkan.</li>
                    </ul>
                </div>
                <div class="alert alert-danger alert-dismissible" role="alert" style="display: none;"
                    id="validation_errors">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        <ul id="alert_message">
                        </ul>
                    </div>
                </div>
            </div>
            <div class="title-header option-title">
                <h5>Halaman Produk</h5>
            </div>
            <div class="title-header option-title d-flex justify-between">
                <div style="width: 200px">
                    <select name="" class="form-select" id="status">
                        <option value="">Tampilkan Semua</option>
                        <option value="stocking">Stok</option>
                        <option value="preorder">Preorder</option>
                    </select>
                </div>
                <a href="{{ route('products.create') }}" class="align-items-center btn btn-theme d-flex">
                    <i data-feather="plus-square"></i>
                    Tambah Produk Baru
                </a>
            </div>
            <div class="table-responsive table-product">
                <table class="table theme-table" id="table_id">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga Jual</th>
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
    <x-product-recommendation></x-product-recommendation>
    <x-delete-product-recommendation></x-delete-product-recommendation>
    <x-product-recommendation></x-product-recommendation>
    <x-delete-modal></x-delete-modal>
    <x-soft-delete-modal></x-soft-delete-modal>

    <script src="{{ asset('dashboard_assets/js/jquery.dataTables.js') }}"></script>
    <script>
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function() {
            var table = $("#table_id").DataTable({
                scrollX: false,
                scrollY: '500px',z
                paging: true,
                ordering: true,
                responsive: true,
                pageLength: 50,
                processing: true,
                serverSide: true,
                searching: true,
                ajax: {
                    url: "{{ route('products.index') }}",
                    data: function(d) {
                        d.status = $('#status').val();
                    }
                },
                columns: [{
                        data: 'photo',
                        name: 'photo'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function(data, type, row) {
                            return '<a href="{{ route('home.products.show', ':slug') }}'.replace(
                                ':slug', row.slug) + '" target="_blank">' + data + '</a>';
                        }
                    },
                    {
                        data: 'category.name',
                        name: 'category.name',
                        render: function(data, type, row) {
                            return '<a href="{{ route('home.category', ':category.id') }}'
                                .replace(':category.id', row.category.id) + '" target="_blank">' +
                                data + '</a>';
                        }
                    },
                    {
                        data: 'sell_price',
                        name: 'sell_price'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#status').on('change', function() {
                table.ajax.reload();
            });

            $(document).on('click', '.delete-alert', function() {
                $('#exampleModal').modal('show')
                const id = $(this).attr('data-id');
                let url = `{{ route('product.destroy', ':id') }}`.replace(':id', id);
                $('#deleteForm').attr('action', url);
            });

            let startDate = null;
            let endDate = null;
            let id = null;

            $(document).on('click', '.product-recommendation', function() {
                id = $(this).attr('data-id');
                startDate = $(this).attr('data-start-date');
                endDate = $(this).attr('data-end-date');
                $('#startDate').val(startDate);
                $('#endDate').val(endDate);
            });

            const showSweetAlert = (data, table) => {
                swal({
                    title: "Berhasil",
                    text: data.meta.message,
                    icon: data.meta.status,
                })
                table.ajax.reload()
            }

            $('#productReccomendations').on('submit', function(e) {
                e.preventDefault();
                startDate = $('#startDate').val()
                endDate = $('#endDate').val()
                const url = `{{ route('product.recommendations.store', ':id') }}`.replace(':id', id);
                const urlRecommendationProduct = `{{ route('product.recommendations.index') }}`;
                $.ajax({
                    url: url,
                    method: 'post',
                    data: {
                        _token: CSRF_TOKEN,
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: (data) => {
                        $('#addProductReccomendationModal').modal('hide')
                        window.location.href = urlRecommendationProduct;
                    },
                    error: (err) => {
                        $('#addProductReccomendationModal').modal('hide')
                        $("#validation_errors").removeAttr("style").css("display", "block");
                        $.each(err.responseJSON.errors, function(index, data) {
                            $('#alert_message').append(`<li>` + data + `</li>`);
                        });
                    }
                })
            });

            $(document).on('click', '.delete-product-recommendation', function() {
                $('#deleteProductRecommendationModal').modal('show')
                const id = $(this).attr('data-id');
                let url = `{{ route('product.recommendations.delete', ':id') }}`.replace(':id', id);
                $('#deleteProductRecommendation').attr('action', url);
            });

            $(document).on('click', '.delete-soft', function() {
                $('#softModal').modal('show')
                const id = $(this).attr('data-id');
                let url = `{{ route('product.soft.delete', ':id') }}`.replace(':id', id);
                $('#deleteSoft').attr('action', url);
            });
        });
    </script>
@endsection
