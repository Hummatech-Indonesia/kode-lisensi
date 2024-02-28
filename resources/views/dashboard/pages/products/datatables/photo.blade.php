@if($data->photo)
    <img width="100px" src="{{ asset('storage/' . $data->photo) }}"
         alt="{{ $data->name }}">
@endif
