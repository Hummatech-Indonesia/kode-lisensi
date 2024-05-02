<div class="modal fade" id="disapproveModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Penolakan penarikan pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="disapproveForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body m-3">
                    <label for="proof" class="form-label">Alasan</label>
                    <textarea name="rejected" id="" cols="15" rows="5" class="form-control"
                        placeholder="berikan alasan yang valid"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Terima</button>
                </div>
            </form>
        </div>
    </div>
</div>
