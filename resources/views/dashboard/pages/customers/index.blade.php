@extends('dashboard.layouts.app')
@section('css')
    <link href="{{ asset('dashboard_assets/css/datatables.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="card card-table">
        <div class="card-body">
            <div class="title-header option-title">
                <h5>Halaman Pelanggan</h5>
            </div>

            <div class="table-responsive table-product">
                <table class="table theme-table" id="table_id">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Nama</th>
                            <th>Nomor Telepon</th>
                            <th>Email</th>
                            <th>Tanggal Registrasi</th>
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
    <x-update-user-modal></x-update-user-modal>
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
                ajax: "/dashboard/users/customer",
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
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false,
                    }
                ]
            });

            $(document).on('click', '.update-alert', function() {
                $('#updateUserModal').modal('show')
                const id = $(this).attr('data-id');
                const name = $(this).attr('data-name');
                const phone_number = $(this).attr('data-phone-number');
                const email = $(this).attr('data-email');
                let url = `{{ route('users.customer.update', ':id') }}`.replace(':id', id);
                console.log(phone_number);
                $('#updateUserForm').attr('action', url);
                $('#nameUpdate').val(name);
                $('#phone_numberUpdate').val(phone_number);
                $('#emailUpdate').val(email);
            });
            $(document).on('click', '.delete-alert', function() {
                $('#exampleModal').modal('show')
                const id = $(this).attr('data-id');
                let url = `{{ route('users.customer.destroy', ':id') }}`.replace(':id', id);
                $('#deleteForm').attr('action', url);
            });
        });
    </script>
@endsection
