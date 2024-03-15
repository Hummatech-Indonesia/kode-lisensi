<div class="modal fade" id="addProductReccomendationModal" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambahkan Tanggal Rekomendasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="productReccomendations" method="POST">
                @csrf
                <div class="modal-body m-3">
                    <div id="divStartDate" class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-3 mb-0">Tanggal Dimulai <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input id="startDate" autocomplete="off" name="start_date" class="form-control"
                                type="date">
                        </div>
                    </div>
                    <div id="divEndDate" class="mb-4 row align-items-center">
                        <label class="form-label-title col-sm-3 mb-0">Tanggal Berakhir <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input id="endDate" autocomplete="off" name="end_date" class="form-control"
                                type="date">
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
