<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Setujui penarikan pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="deleteForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body m-3">
                    <p class="mb-0">Setujui penarikan pembayaran?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Terima</button>
                </div>
            </form>
        </div>
    </div>
</div>
