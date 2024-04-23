@extends('dashboard.layouts.app')
@section('content')
    <div class="card">
        THIS IS ADMINISTRATOR PAGE
        TOP PELANGGAN
        <div class="table-responsive">
            <table class="table variation-table table-hover">
<thead>
    <tr>
        <th>#</th>
        <th>Nama Pelanggan</th>
        <th>Jumlah Produk dibeli</th>
        {{-- <th>Total Pengeluaran</th> --}}
    </tr>
</thead>
@foreach ($users as $user)
    <tbody>
        <tr>
            <td>{{$user->iteration}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->transactions->count()}}</td>
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
    <script>

    </script>
@endsection
