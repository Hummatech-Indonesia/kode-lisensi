@if($data->image)
    <img width="100px" src="{{ asset('storage/' . $data->image) }}"
         alt="{{ $data->offer }}">
@endif
