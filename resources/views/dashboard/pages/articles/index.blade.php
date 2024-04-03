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
            <div class="title-header option-title">
                <h5>Halaman Artikel</h5>
                <form class="d-inline-flex">
                    <a href="{{ route('articles.create') }}" class="align-items-center btn btn-theme d-flex">
                        <i data-feather="plus-square"></i>
                        Tambah Artikel
                    </a>
                </form>
            </div>

            <div class="table-responsive table-product">
                <table class="table theme-table" id="table_id">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Thumbnail</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Tanggal dipublish</th>
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
                ajax: "{{ route('articles.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'category.name',
                        name: 'category.name'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'photo',
                        name: 'photo'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            return new Date(data).toLocaleDateString('id-ID', {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            });
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]
            });

            $(document).on('click', '.delete-alert', function() {
                $('#exampleModal').modal('show')
                const id = $(this).attr('data-id');
                let url = `{{ route('articles.destroy', ':id') }}`.replace(':id', id);
                $('#deleteForm').attr('action', url);
            });

        });
    </script>
@endsection
