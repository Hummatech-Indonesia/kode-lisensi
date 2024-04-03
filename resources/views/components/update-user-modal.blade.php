<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="POST" id="updateUserForm">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mt-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" id="nameUpdate" class="form-control">
                    <label for="rekening" class="form-label">Nomor Telepon</label>
                    <input type="text" name="phone_number" id="phone_numberUpdate" class="form-control">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="emailUpdate" class="form-control">

                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary" type="submit">Perbarui</button>
                        <button class="btn btn-danger ms-3" data-bs-dismiss="modal" type="button">Batalkan
                        </button>
                    </div>
            </form>

        </div>
    </div>
</div>
</div>
