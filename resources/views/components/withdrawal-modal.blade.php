<div class="modal fade" id="withdrawal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tarik Saldo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="balanceWithdrawalPost" method="POST">
                @csrf
                <div class="modal-body">
                    <label for="balance" class="form-label">Saldo yang ditarik</label>
                    <input type="number" name="balance" id="balance" class="form-control">
                </div>
                <div class="modal-body">
                    <label for="pin" class="form-label">Masukkan PIN</label>
                    <input type="password" name="pin" id="pin" class="form-control">
                </div>
                <div class="modal-body mt-3">
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary">Konfirmasi Penarikan</button>
                        <button class="btn btn-danger ms-3" data-bs-dismiss="modal">Batalkan penarikan</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
</div>
