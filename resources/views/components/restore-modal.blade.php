<div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi aktivasi produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="restoreForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body m-3">
                    <p class="mb-0">Data akan tampil dan dapat dibeli kembali</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Aktifkan</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
