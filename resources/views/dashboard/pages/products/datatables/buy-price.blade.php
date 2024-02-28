@if (!$data->varianProducts->isEmpty())
    @php
        $buyPrices = $data->varianProducts->pluck('buy_price')->toArray();
        $minPrice = number_format(min($buyPrices) / 1000, 0, ',', '.');
        $maxPrice = number_format(max($buyPrices) / 1000, 0, ',', '.');
    @endphp

    @if ($data->varianProducts->count() > 2)
        <span class="theme-price">Rp. {{ $minPrice }}rb - Rp. {{ $maxPrice }}rb</span>
    @else
        @php
            $formattedPrices = $data->varianProducts->map(function ($varianProduct) {
                return 'Rp. ' . number_format($varianProduct->buy_price / 1000, 0, ',', '.') . 'rb';
            })->implode(', ');
        @endphp
        {!! $formattedPrices !!}
    @endif
@else
<p>Rp. {{ number_format($data->buy_price, 2, ',', '.') }}</p>
@endif
