@php
    use App\Enums\BalanceUsedEnum;
    use App\Enums\UsedForEnum;
@endphp

<!-- Modal -->
<div class="modal fade" id="updateExpenditureModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" id="updateForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal Update Pengeluaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="" class="form-label">Penggunaan</label>
                    <select name="used_for" id="usedFor" class="form-select">
                        <option value="">Pilih Penggunaan</option>
                        <option value="{{ UsedForEnum::BUYPRODUCT->value }}">Beli Produk</option>
                        <option value="{{ UsedForEnum::PAYRESELLER->value }}">Bayar Reseller</option>
                        <option value="{{ UsedForEnum::OTHERS }}">Lainnya</option>
                    </select>
                    <label for="" class="form-label">Penarikan saldo melalui</label>
                    <select name="balance_used" id="balanceUsed" class="form-select">
                        <option value="">Pilih Penarikan Saldo</option>
                        <option value="{{ BalanceUsedEnum::TRIPAY->value }}">Tripay</option>
                        <option value="{{ BalanceUsedEnum::REKENING->value }}">Rekening</option>
                    </select>
                    <label for="" class="form-label">Nominal Pengeluaran</label>
                    <input type="number" name="balance_withdrawn" id="balanceWithdrawn" class="form-control"
                        placeholder="100.000">
                    <label for="" class="form-label">Deskripsi</label>
                    <textarea name="description" id="description" cols="15" rows="5" class="form-control" placeholder="deskripsi"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>