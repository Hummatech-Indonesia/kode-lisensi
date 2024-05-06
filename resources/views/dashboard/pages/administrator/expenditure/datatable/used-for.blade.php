@php
    use App\Enums\UsedForEnum;

@endphp

@if (UsedForEnum::BUYPRODUCT->value)
    <p>Beli Produk</p>
@elseif(UsedForEnum::PAYRESELLER->value)
    <p>Membayar Reseller</p>
@elseif(UsedFOrEnum::OTHERS->value)
    <p>Lainnya</p>
@endif
