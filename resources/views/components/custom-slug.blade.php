<div class="modal fade" id="customSlugModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kustomisasi Slug</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="customSlugForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body m-3">
                    <div class="form-group">
                        <label for="" class="form-label">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
