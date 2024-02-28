@if ($data->buy_price == 0)
    <span class="">Produk Bervariasi</span>
@else
    <p>Rp. {{ number_format($data->buy_price, 2, ',', '.') }}</p>
@endif
