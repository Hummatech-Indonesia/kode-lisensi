@php
    use App\Enums\BalanceUsedEnum;
    use App\Enums\UsedForEnum;
@endphp

<!-- Modal -->
<div class="modal fade" id="addExpenditureModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('dashboard.expenditure.store') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal Tambah Data Pengeluaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="" class="form-label">Penggunaan</label>
                    <select name="used_for"  class="form-select">
                        <option value="">Pilih Penggunaan</option>
                        <option value="{{ UsedForEnum::BUYPRODUCT->value }}">Beli Produk</option>
                        <option value="{{ UsedForEnum::PAYRESELLER->value }}">Bayar Reseller</option>
                        <option value="{{ UsedForEnum::OTHERS }}">Lainnya</option>
                    </select>
                    <label for="" class="form-label">Penarikan saldo melalui</label>
                    <select name="balance_used"  class="form-select">
                        <option value="">Pilih Penarikan Saldo</option>
                        <option value="{{ BalanceUsedEnum::TRIPAY->value }}">Tripay</option>
                        <option value="{{ BalanceUsedEnum::REKENING->value }}">Rekening</option>
                    </select>
                    <label for="" class="form-label">Nominal Pengeluaran</label>
                    <input type="number" name="balance_withdrawn"  class="form-control"
                        placeholder="100.000">
                    <label for="" class="form-label">Deskripsi</label>
                    <textarea name="description"  cols="15" rows="5" class="form-control" placeholder="deskripsi"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
