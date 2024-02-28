@if (!$data->varianProducts->isEmpty())
    @php
        $sellPrices = $data->varianProducts->pluck('sell_price')->toArray();
        $minPrice = number_format(min($sellPrices) / 1000, 0, ',', '.');
        $maxPrice = number_format(max($sellPrices) / 1000, 0, ',', '.');
    @endphp

    @if ($data->varianProducts->count() > 2)
        <span class="theme-price">Rp. {{ $minPrice }}rb - Rp. {{ $maxPrice }}rb</span>
    @else
        @php
            $formattedPrices = $data->varianProducts
                ->map(function ($varianProduct) {
                    return 'Rp. ' . number_format($varianProduct->sell_price / 1000, 0, ',', '.') . 'rb';
                })
                ->implode(', ');
        @endphp
        {!! $formattedPrices !!}
    @endif
@else
    <p>Rp. {{ number_format($data->sell_price, 2, ',', '.') }}</p>
@endif
