@php
    use App\Helpers\RefundHelper;
    use App\Helpers\CurrencyHelper;
@endphp

<!-- Modal -->
<div class="modal fade" id="addRefundModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" id="addRefund" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Ajukan Pengembalian Dana</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="rekening_number" class="form-label">Nomor Rekening</label>
                        <input type="number" name="rekening_number" id="rekening_number" class="form-control"
                            placeholder="3928428xxx">
                    </div>
                    <div class="mb-2">
                        <label for="bank" class="form-label">Nama Bank</label>
                        <input type="text" name="bank" id="bank" class="form-control"
                            placeholder="Nama Bank">
                    </div>
                    <div class="mb-2">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="description" cols="15" rows="5" class="form-control"
                            placeholder="deskripsi"></textarea>
                    </div>
                    <div class="mb-2">
                        <label for="proof" class="form-label">Unggah Bukti Bahwa Terjadi Eror, dsb Pada
                            Lisensinya</label>
                        <input type="file" name="proof" class="form-control" id="proof">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
