<!-- Modal -->
<div class="modal fade" id="approveRefundModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" id="formApprove" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi penolakan permintaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <label for="rejected">Pilih Metode Pembayaran</label>
                        <select name="balance_used" id="" class="form-control">
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="tripay">Tripay</option>
                            <option value="rekening">Rekening</option>
                        </select>
                    </div>
                    <div class="">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" id="" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="">
                        <label for="rejected">Kirim Bukti Pembayaran</label>
                        <input type="file" name="proof_admin" class="form-control" id="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
