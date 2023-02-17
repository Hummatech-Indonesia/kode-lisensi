@if($data->licenses_count == 0)
    <span class="badge badge-danger">Stok habis</span>
@else
    <span class="badge badge-success">{{ $data->licenses_count . " stok" }} </span>
@endif
