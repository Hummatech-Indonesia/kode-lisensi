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
                            <th scope="col" colspan="3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekeningNumbers as $rekeningNumber)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $rekeningNumber->name }}</td>
                                <td>{{ $rekeningNumber->rekening }}</td>
                                <td>{{ $rekeningNumber->rekening_number }}</td>
                                <td><button class="btn btn-primary" id="balanceWithdrawal"
                                        data-id="{{ $rekeningNumber->id }}">
                                        Tarik
                                        Saldo</button></td>
                                <td><button class="btn btn-danger" id="deleteRekening"
                                        data-id="{{ $rekeningNumber->id }}">Delete</button></td>
                                <td><button class="btn btn-warning" id="updateRekening" data-id="{{ $rekeningNumber->id }}"
                                        data-name="{{ $rekeningNumber->name }}"
                                        data-rekening={{ $rekeningNumber->rekening }}
                                        data-rekening-number="{{ $rekeningNumber->rekening_number }}"><i class="ri-pencil-line"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <x-create-rekening-modal></x-create-rekening-modal>
        </div>
    </div>
@endsection

@section('script')
    <x-withdrawal-modal></x-withdrawal-modal>
    <x-update-rekening-modal></x-update-rekening-modal>
    <x-delete-rekening-modal></x-delete-rekening-modal>
    <script src="{{ asset('dashboard_assets/js/jquery.dataTables.js') }}"></script>
    <script>
        $(document).on('click', '#deleteRekening', function() {
            $('#deleteRekeningModal').modal('show')
            const id = $(this).attr('data-id');
            let url = `{{ route('dashboard.balance.withdrawal.rekening-numbers.destroy', ':id') }}`.replace(':id',
                id);
            $('#deleteRekeningForm').attr('action', url);
        });

        $(document).on('click', '#updateRekening', function() {
            $('#updateRekeningModal').modal('show')
            const id = $(this).data('id');
            const name = $(this).attr('data-name');
            const rekening = $(this).attr('data-rekening');
            const rekeningNumber = $(this).attr('data-rekening-number');
            let url = `{{ route('dashboard.balance.withdrawal.rekening-numbers.update', ':id') }}`.replace(':id',
                id);
            $('#nameUpdate').val(name);
            $('#rekeningUpdate').val(rekening);
            $('#rekening_numberUpdate').val(rekeningNumber);
            $('#updateRekeningForm').attr('action', url);
        });

        $(document).on('click', '#balanceWithdrawal', function() {
            $('#withdrawal').modal('show')
            const id = $(this).data('id');
            let url = `{{ route('dashboard.balance.withdrawal.store', ':id') }}`.replace(':id',
                id);
            $('#balance').val();
            $('#pin').val();
            console.log(id);
            $('#balanceWithdrawalPost').attr('action', url);
        });
    </script>
@endsection
