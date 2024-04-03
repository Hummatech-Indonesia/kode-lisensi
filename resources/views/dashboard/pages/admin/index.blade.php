@extends('dashboard.layouts.app')
@section('css')
    <link href="{{ asset('dashboard_assets/css/datatables.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @if (session('success'))
        <x-alert-success></x-alert-success>
    @endif
    <div class="card card-table">
        <div class="card-body">
            <div class="title-header option-title">
                <h5>Halaman Pengguna Admin dan Author</h5>
            </div>
            <div style="width: 200px" class="mb-4">
                <select name="" class="form-select" id="role">
                    <option value="">Tampilkan Semua</option>
                    <option value="admin">Admin</option>
                    <option value="author">Author</option>
                </select>
            </div>
            <div class="table-responsive table-product">
                <table class="table theme-table" id="table_id">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Nama</th>
                            <th>Email</th>
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
    <x-delete-modal></x-delete-modal>
    <script src="{{ asset('dashboard_assets/js/jquery.dataTables.js') }}"></script>
    <script>
        $(document).ready(function() {



            // Datatables Responsive
            $("#table_id").DataTable({
                scrollX: false,
                scrollY: '500px',
                paging: true,
                ordering: true,
                responsive: true,
                pageLength: 50,
                processing: true,
                serverSide: false,
                searching: true,
                ajax: {
                    url: "{{ route('users.admin.index') }}",
                    data: function(d) {
                        // Memeriksa nilai opsi yang dipilih
                        var roleValue = $('#role').val();
                        if (roleValue === '') {
                            // Jika opsi "Tampilkan Semua" dipilih, kirim data kosong
                            // ini akan memicu server untuk mengembalikan semua jenis pengguna
                            d.role = ['admin', 'author'];
                        } else {
                            // Jika opsi lain dipilih, kirim nilai role seperti biasa
                            d.role = roleValue;
                        }
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'photo',
                        name: 'photo'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
            $('#role').on('change', function() {
                $("#table_id").DataTable().ajax.reload();
            });
        });
        $(document).on('click', '.delete-alert', function() {
            $('#exampleModal').modal('show')
            const id = $(this).attr('data-id');
            let url = `{{ route('users.delete', ':id') }}`.replace(':id', id);
            $('#deleteForm').attr('action', url);
        });
    </script>
@endsection
