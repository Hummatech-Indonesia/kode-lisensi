@if ($data->status == 0)
    @if ($data->rejected)
        <p class="badge badge-danger">Ditolak</p>
    @else
        <p class="badge badge-warning">Diproses</p>
    @endif
@else
    <p class="badge badge-success">Diterima</p>
@endif
