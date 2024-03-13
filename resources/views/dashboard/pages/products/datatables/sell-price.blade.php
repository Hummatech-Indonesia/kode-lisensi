@if ($data->varianProducts->first())
    @foreach ($data->varianProducts as $varianProduct)
            <p>{{ $varianProduct->name }} : Rp. {{ number_format($varianProduct->sell_price, 2, ',', '.') }}</p>
    @endforeach
@else
    <p>Rp. {{ number_format($data->sell_price, 2, ',', '.') }}</p>
@endif
