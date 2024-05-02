@php
    use App\Enums\StatusRefundEnum;

@endphp
@if ($data->status == StatusRefundEnum::PENDING->value)
    <p class="badge badge-warning">Diproses</p>
@else
    @if ($data->rejected)
        <p class="badge badge-danger">Ditolak</p>
    @else
        <p class="badge badge-primary">Diterima</p>
    @endif
@endif
