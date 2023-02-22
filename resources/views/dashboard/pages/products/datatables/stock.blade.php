@php use App\Enums\ProductStatusEnum; @endphp
@if($data->status == ProductStatusEnum::PREORDER->value)
    <span class="badge badge-danger">preorder</span>
@else
    @if($data->licenses_count == 0)
        <span class="badge badge-danger">Stok habis</span>
    @else
        <span class="badge badge-success">{{ $data->licenses_count . " stok" }} </span>
    @endif
@endif

