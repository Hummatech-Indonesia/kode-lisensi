@php
    use App\Enums\UsedForEnum;
    use App\Enums\BalanceUsedEnum;

@endphp

@extends('dashboard.layouts.app')
@section('content')
    <div class="container">
        <!-- Button trigger modal -->
        <div class="d-flex justify-content-end mb-3">

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Tambah Data
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('dashboard.expenditure.store') }}" method="post">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="" class="form-label">Penggunaan</label>
                            <select name="used_for" id="" class="form-select">
                                <option value="">Pilih Penggunaan</option>
                                <option value="{{UsedForEnum::BUYPRODUCT}}">Beli Produk</option>
                                <option value="pay_reseller">Bayar Reseller</option>
                                <option value="other">Lainnya</option>
                            </select>
                            <label for="" class="form-label">Penarikan saldo melalui</label>
                            <select name="balance_used" id="" class="form-select">
                                <option value="">Pilih Penarikan Saldo</option>
                                <option value="tripay">Tripay</option>
                                <option value="rekening">Rekening</option>
                            </select>
                            <label for="" class="form-label">Nominal Pengeluaran</label>
                            <input type="number" name="balance_withdrawn" id="" class="form-control"
                                placeholder="100.000">
                            <label for="" class="form-label">Deskripsi</label>
                            <textarea name="description" id="" cols="15" rows="5" class="form-control" placeholder="deskripsi"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="table-responsive">

            <table class="table variation-table-sm table-hover">
                <thead class="bg-primary">
                    <th>#</th>
                    <th>Penggunaan</th>
                    <th>Penarikan melalui</th>
                    <th>Saldo yand ditarik</th>
                    <th>Deskripsi</th>
                    <th colspan="2">Aksi</th>
                </thead>
                <tbody>
                    @foreach ($expenditures as $expenditure)
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $expenditure->used_for }}</td>
                        <td>{{ $expenditure->balance_used }}</td>
                        <td>{{ $expenditure->balance_withdrawn }}</td>
                        <td>{{ $expenditure->description }}</td>
                        <td><button class="btn btn-warning">Update</button></td>
                        <td><button class="btn btn-danger">Delete</button></td>
                    @endforeach
                </tbody>
        </div>
        </table>
    </div>
@endsection
