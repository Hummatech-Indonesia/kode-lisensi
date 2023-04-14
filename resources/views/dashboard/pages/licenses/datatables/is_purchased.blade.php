@if($data->is_purchased == 0)
    <span class="badge badge-primary">Tersedia</span>
@else
    <span class="badge badge-danger">Terjual</span>
@endif
