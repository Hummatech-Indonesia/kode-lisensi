@extends('dashboard.layouts.app')
@section('css')
    <link href="{{ asset('dashboard_assets/css/datatables.css') }}" rel="stylesheet" type="text/css"/>
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
                <h5>Halaman Kontak Kami</h5>
                <form class="d-inline-flex" method="POST" action="{{ route('contact-us.forceDelete') }}">
                    @method("DELETE")
                    @csrf
                    <button onclick="return confirm('Yakin ingin menghapus seluruh pesan?')"
                            class="align-items-center btn btn-danger d-flex">Hapus Seluruh Pesan
                    </button>
                </form>
            </div>

            <div class="table-responsive category-table">
                <div>
                    <table class="table theme-table" id="table_id">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Pesan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $contact->firstname . " " . $contact->lastname }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone_number }}</td>
                                <td>{{ $contact->message }}</td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('dashboard_assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/custom-data-table.js') }}"></script>
@endsection
