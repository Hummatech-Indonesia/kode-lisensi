<div class="modal fade" id="addLicensesModal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
     data-bs-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambahkan Lisensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="addLicenses" method="POST">
                @csrf
                <div class="modal-body m-3">
                    <div id="divUsername" class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-3 mb-0">Username <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input id="addUsername" autocomplete="off" name="username" class="form-control" type="text"
                                   placeholder="johndoe437@example.net">
                        </div>
                    </div>
                    <div id="divPassword" class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-3 mb-0">Password <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input id="addPassword" autocomplete="off" name="password" class="form-control" type="text"
                                   placeholder="T2XiPgYmJ">
                        </div>
                    </div>
                    <div id="divSerial" class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-3 mb-0">Serial Key <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input id="addSerial_key" autocomplete="off" name="serial_key" class="form-control"
                                   type="text"
                                   placeholder="BGY78-HUNGY-7TFVD-5RSE4-KWA3Z">
                        </div>
                    </div>
                    <div id="divDescription" class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-3 mb-0">Description <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input id="addDescription" autocomplete="off" name="description" class="form-control"
                                   type="text"
                                   placeholder="BGY78-HUNGY-7TFVD-5RSE4-KWA3Z">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
