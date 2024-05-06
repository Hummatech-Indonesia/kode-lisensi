@php
    use App\Enums\UsedForEnum;
@endphp

@if ($data->used_for == UsedForEnum::BUYPRODUCT->value)
    <p>Beli Produk</p>
@elseif($data->used_for == UsedForEnum::PAYRESELLER->value)
    <p>Membayar Reseller</p>
@elseif($data->used_for == UsedFOrEnum::OTHERS->value)
    <p>Lainnya</p>
@endif
