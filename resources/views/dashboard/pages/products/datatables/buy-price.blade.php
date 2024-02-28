@if ($data->sell_price == 0)
    <span class="">Produk Bervariasi</span>
@else
    <p>Rp. {{ number_format($data->sell_price, 2, ',', '.') }}</p>
@endif
