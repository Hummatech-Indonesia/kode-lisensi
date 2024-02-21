@if($data->photo)
    <img width="75px" class="rounded-circle"
         src="{{ asset('storage/' . $data->photo) }}"
         alt="{{ $data->name }}">
@else
    <img width="75px" class="rounded-circle" src="{{ asset('avatar.png') }}"
         alt="{{ $data->name }}">
@endif
