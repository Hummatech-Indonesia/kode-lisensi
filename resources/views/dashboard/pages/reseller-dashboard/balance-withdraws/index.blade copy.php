@extends('dashboard.layouts.app')
@section('content')
<div class="card card-table">
    <div class="card-body">
        <div class="col-sm-6 mb-3">
            @if (session('success'))
            <x-alert-success></x-alert-success>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="alert-message">
                    <strong>Terjadi Kesalahan!</strong>
                    @foreach ($errors->all() as $error)
                    {{ $error }}
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        <div class="title-header option-title">
            <h5>Penarikan Saldo</h5>
            <div class="d-inline-flex">
                <a id="btnSettingLicense" data-bs-toggle="modal" data-bs-target="#settingLicense"
                    class="btn btn-primary">Setting Pin Rekening Anda</a>

                {{-- Modal Setting Pin Rekening --}}
                <div class="modal fade" id="settingLicense" tabindex="-1" role="dialog" aria-hidden="true"
                    data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambahkan PIN</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('dashboard.pin.rekening.send.email') }}" method="POST">
                                @csrf
                                <div class="modal-body m-3">
                                    <div class="col-sm-12 mb-3">
                                        <div class="alert alert-warning">
                                            <p style="font-size: 14px">Catatan: </p>
                                            <p style="font-size: 14px">Pin yang anda inputkan wajib 6 karakter </p>
                                            @if (auth()->user()->pinRekening)
                                            <p style="font-size: 14px">Anda sudah memiliki pin sebelumnya
                                                ({{ $pin }}....),
                                                apakah
                                                anda
                                                ingin menggantinya? </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div id="divUsername" class="mb-4 row align-items-center">
                                        <label for="pin" class="form-label-title col-sm-3 mb-0">PIN Anda <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input id="pin" autocomplete="off" name="pin" class="form-control"
                                                type="number">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body mt-5">
        <form action="{{ route('dashboard.balance.withdrawal.store') }}" method="post">
            @csrf
            <div class="">
                <label for="via">Pilih Metode Penarikan</label>
                <select name="via" class="form-select @error('via') is-invalid @enderror" id="via">
                    <option value="">Pilih metode penarikan</option>
                    <option value="bluebca" {{ old('via')=='bluebca' ? 'selected' : '' }}>Blue Bca</option>
                    <option value="dana" {{ old('via')=='dana' ? 'selected' : '' }}>Dana</option>
                    <option value="ovo" {{ old('via')=='ovo' ? 'selected' : '' }}>Ovo</option>
                    <option value="gopay" {{ old('via')=='gopay' ? 'selected' : '' }}>Gopay</option>
                </select>
                @error('via')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mt-3">
                <label for="rekening_number">No Handphone / No Rekening</label>
                <input type="number" name="rekening_number"
                    class="form-control @error('rekening_number') is-invalid @enderror" id=""
                    value="{{ old('rekening_number') }}">
                @error('rekening_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mt-3">
                <label for="balance">Jumlah Penarikan</label>
                <input type="number" name="balance" class="form-control @error('rekening_number') is-invalid @enderror"
                    id="" value="{{ old('balance') }}">
                @error('balance')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <p class="mt-2" style="color: #0DA487">Minimal penarikan saldo adalah Rp. 50.000,00</p>
            </div>

            <div class="d-flex justify-content-end">
                <a id="btnBalanceWithdrawals" data-bs-toggle="modal" style="width: 20%"
                    data-bs-target="#balanceWithdrawals" class="btn btn-primary col-sm-6">Lanjutkan</a>
            </div>
            {{-- Modal Setting Pin Rekening --}}
            <div class="modal fade" id="balanceWithdrawals" tabindex="-1" role="dialog" aria-hidden="true"
                data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Masukkan Pin Anda</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body m-3">
                            <div id="divUsername" class="mb-4 row align-items-center">
                                <label for="pin" class="form-label-title col-sm-3 mb-0">PIN Anda <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input id="pin" autocomplete="off" name="pin"
                                        class="form-control @error('pin') is-invalid @enderror" type="password">
                                    @error('pin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
