@extends('dashboard.layouts.app')
@section('css')
    <link href="{{ asset('dashboard_assets/css/datatables.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="card card-table">
        <div class="col-sm-6 mb-3">
            @if (session('success'))
                <x-alert-success></x-alert-success>
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
            <div class="d-flex justify-content-end mb-3">

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
    <script>
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function() {

            function rupiahCurrency(number) {
                return "Rp " + number.toLocaleString('id-ID');
            }

            var table = $("#table_id").DataTable({
                scrollX: false,
                scrollY: '500px',
                paging: true,
                ordering: true,
                responsive: true,
                pageLength: 50,
                processing: true,
                serverSide: false,
                searching: true,
                ajax: "{{ route('dashboard.fetch.expenditure') }}",

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

            $('#status').on('change', function() {
                table.ajax.reload();
            });

            const showSweetAlert = (data, table) => {
                swal({
                    title: "Berhasil",
                    text: data.meta.message,
                    icon: data.meta.status,
                })
                table.ajax.reload()
            }


        });
        $('.dataTables_scrollBody').css({
            'position': 'relative',
            'overflow': 'auto',
            'max-height': 'none',
            'height': 'max-content',
            'width': '100%'
        });

        $(document).on('click', '.update-alert', function() {
            $('#updateExpenditureModal').modal('show')
            const id = $(this).data('id');
            const usedFor = $(this).data('used-for');
            const balanceUsed = $(this).data('balance-used');
            const balanceWithdrawn = $(this).data('balance-withdrawn');
            const description = $(this).data('description');
            let url = `{{ route('dashboard.expenditure.update', ':id') }}`.replace(':id',
                id);
            console.log(id);
            console.log(usedFor);
            console.log(balanceUsed);
            console.log(balanceWithdrawn);
            console.log(description);
            $('#usedFor').val(usedFor);
            $('#balanceUsed').val(balanceUsed);
            $('#balanceWithdrawn').val(balanceWithdrawn);
            $('#description').val(description);
            $('#updateForm').attr('action', url);
            console.log(url);
        });
        $(document).on('click', '.delete-alert', function() {
            $('#deleteExpenditureModal').modal('show')
            const id = $(this).attr('data-id');
            console.log(id);
            let url = `{{ route('dashboard.expenditure.destroy', ':id') }}`.replace(':id', id);
            console.log(url);
            $('#deleteForm').attr('action', url);
        });
    </script>
@endsection
