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

                    <button class="btn btn-primary ms-3" data-bs-target="#rekening" data-bs-toggle="modal">
                        Tambahkan nomor rekening</button>



                </div>
            </div>
        </div>
        <div class="card-body mt-5">

            <div class="table-responsive">
                <table class="table variation-table">
                    <thead class="bg-primary">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Pemilik</th>
                            <th scope="col">Nama Bank</th>
                            <th scope="col">Nomor Rekening</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Frendika</td>
                            <td>BRIVA</td>
                            <td>123456789</td>
                            <td><button class="btn btn-primary" data-bs-target="#withdrawal" data-bs-toggle="modal">
                                    Tarik
                                    Saldo</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <x-create-rekening-modal></x-create-rekening-modal>
            <x-withdrawal-modal></x-withdrawal-modal>
        </div>
    </div>
@endsection

@section('script')
@endsection
