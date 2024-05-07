@extends('dashboard.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="alert alert-warning">
                Catatan: <br>
                <ul>
                    <li>Lisensi akan dikirimkan via email customer dan pastikan lisensi yang dikirim sudah benar.</li>
                    <li>file tutorial instalasi akan dikirim secara otomatis pada email.</li>
                </ul>

            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-sm-8 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header-2">
                                <h5>Invoice ID: {{ $transaction->invoice_id }}</h5>
                            </div>


                            <form enctype="multipart/form-data"
                                action="{{ route('orders.update', $transaction->invoice_id) }}"
                                class="theme-form theme-form-2 mega-form" method="POST" id="sendLicense">
                                @csrf
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Nama Pelanggan</label>
                                    <div class="col-sm-9">
                                        <input name="name" value="{{ $transaction->user->name }}" readonly
                                            autocomplete="off" class="form-control" type="text"
                                            placeholder="Nama Kategori">
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <div class="col-sm-3 form-label-title">Produk dibeli</div>
                                    <div class="col-sm-9">
                                        <input name="icon" class="form-control" type="text" readonly
                                            value="{{ $transaction->detail_transaction->product->name }}">
                                    </div>
                                </div>
                                @if ($transaction->detail_transaction->varianProduct)

                                <div class="mb-4 row align-items-center">
                                    <div class="col-sm-3 form-label-title">Variasi Produk</div>
                                    <div class="col-sm-9">
                                        <input name="icon" class="form-control" type="text" readonly
                                        value="{{ $transaction->detail_transaction->varianProduct->name }}">
                                    </div>
                                </div>
                                @endif

                                <div id="divUsername" class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Username <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input required id="addUsername" autocomplete="off" name="username"
                                            class="form-control" type="text" placeholder="johndoe437@example.net">
                                    </div>
                                </div>
                                <div id="divPassword" class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Password <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input required id="addPassword" autocomplete="off" name="password"
                                            class="form-control" type="text" placeholder="T2XiPgYmJ">
                                    </div>
                                </div>
                                <div id="divSerial" class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Serial Key <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input required id="addSerial_key" autocomplete="off" name="serial_key"
                                            class="form-control" type="text" placeholder="BGY78-HUNGY-7TFVD-5RSE4-KWA3Z">
                                    </div>
                                </div>
                                <div id="divDescription" class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-0 mb-0">Deskripsi <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                @if ($transaction->detail_transaction->note)
                                <div class="mb-4 row align-items-center">
                                    <label for="" class="form-label-title col sm-0 mb-3">Catatan Pembeli <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                        <textarea name="" id="" cols="15" rows="5" class="form-control" readonly>{{ $transaction->detail_transaction->note }}</textarea>
                                    </div>
                                </div>
                                @endif

                                <div class="mb-4 row align-items-center">
                                    <div class="col-sm-6">

                                        <button class="btn btn-primary" type="submit" id="btnSendLicense">Kirim Lisensi
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(() => {
            CKEDITOR.replace('description');

            const type = `{{ $transaction->detail_transaction->product->type }}`

            if (type === 'serial') {
                $('#divUsername').remove();
                $('#divPassword').remove();
                $('#divDescription').remove();
            } else if (type === 'credential') {
                $('#divDescription').remove()
                $('#divSerial').remove();
            } else {
                $('#divUsername').remove();
                $('#divPassword').remove();
                $('#divSerial').remove();
            }

            $('#btnSendLicense').on('click', function(e) {
                e.preventDefault()
                swal({
                    title: "Yakin ingin kirim lisensi?",
                    text: "Pastikan lisensi yang dikirim sudah benar",
                    icon: "warning",
                    buttons: {
                        confirm: 'Ya',
                        cancel: 'Batal'
                    },
                    dangerMode: true,
                }).then((act) => {
                    if (act) {
                        $('#sendLicense').submit();
                    }
                });
            })
        })
    </script>
@endsection
