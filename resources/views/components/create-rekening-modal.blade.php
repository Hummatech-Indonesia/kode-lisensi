<div class="modal fade" id="rekening" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('dashboard.balance.withdrawal.rekening-numbers.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambahkan Rekening</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mt-3">
                    <label for="name" class="form-label">Nama Pemilik</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nama anda">
                    <label for="rekening" class="form-label">Nama Bank</label>
                    <input type="text" name="rekening" id="rekening" class="form-control" placeholder="Bank BRI">
                    <label for="rekening_number" class="form-label">Nomor Rekening</label>
                    <input type="number" name="rekening_number" id="rekening_number" class="form-control" placeholder="19423847">

                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary" type="submit">Tambahkan nomor rekening</button>
                        <button class="btn btn-danger ms-3" data-bs-dismiss="modal" type="button">Batalkan
                        </button>
                    </div>
            </form>

        </div>
    </div>
</div>
</div>
