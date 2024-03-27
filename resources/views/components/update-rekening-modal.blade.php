<div class="modal fade" id="updateRekeningModal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="POST"
                id="updateRekeningForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Perbarui Rekening</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mt-3">
                    <label for="name" class="form-label">Nama Pemilik</label>
                    <input type="text" name="name" id="nameUpdate" class="form-control">
                    <label for="rekening" class="form-label">Nama Bank</label>
                    <input type="text" name="rekening" id="rekeningUpdate" class="form-control">
                    <label for="rekening_number" class="form-label">Nomor Rekening</label>
                    <input type="number" name="rekening_number" id="rekening_numberUpdate" class="form-control">

                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary" type="submit">Perbarui nomor rekening</button>
                        <button class="btn btn-danger ms-3" data-bs-dismiss="modal">Batalkan
                        </button>
                    </div>
            </form>

        </div>
    </div>
</div>
</div>
