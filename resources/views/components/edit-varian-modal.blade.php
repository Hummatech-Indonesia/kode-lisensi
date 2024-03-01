{{-- edit varian modal component --}}

<div class="modal fade" id="editVarianModal{{ $varianProduct->id }}" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Varian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('update.varian.product',$varianProduct->id)}}" method="POST">
                @method('PATCH')
                @csrf
                <div class="modal-body m-3">
                    <div class="mb-4 row align-items-center">
                        <label for="" class="form-label-title col-sm-3 mb-0">Nama Varian</label>
                        <div class="col-sm-9">
                            <input type="text" autocomplete="off" name="name" id="" class="form-control"
                                value="{{ $varianProduct->name }}">
                        </div>
                    </div>
                    <div class="mb-4 row align-items-center">
                        <label for="" class="form-label-title col-sm-3 mb-0">Harga Beli</label>
                        <div class="col-sm-9">
                            <input type="number" autocomplete="off" name="buy_price" id="" class="form-control"
                                value="{{ $varianProduct->buy_price }}">
                        </div>
                    </div>
                    <div class="mb-4 row align-items-center">
                        <label for="" class="form-label-title col-sm-3 mb-0">Harga Jual</label>
                        <div class="col-sm-9">
                            <input type="number" autocomplete="off" name="sell_price" id="" class="form-control"
                                value="{{ $varianProduct->sell_price }}">
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
