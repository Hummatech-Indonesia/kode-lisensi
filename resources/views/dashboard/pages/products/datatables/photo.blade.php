@if($data->photo)
    <div class="table-image">
        <img src="{{ asset('storage/' . $data->photo) }}" class="img-fluid" alt="{{ $data->name }}">
    </div>
@else
    <div class="table-image">
        <img src="{{ asset('avatar.png') }}" class="img-fluid" alt="avatar">
    </div>
@endif
