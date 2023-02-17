@if($data->photo)
    <div class="row">
        <div class="col-sm-2">
            <img width="50px" class="rounded-circle"
                 src="{{ asset('storage/' . $data->photo) }}"
                 alt="{{ $data->name }}">
        </div>
        <div class="col-sm-10">
            <span class="p-1">{{ $data->name }}</span>
            <br/>
            <span class="badge badge-primary p-1">{{ $data->email }}</span>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-sm-2">
            <img width="50px" class="rounded-circle" src="{{ asset('avatar.png') }}"
                 alt="{{ $data->name }}">
        </div>
        <div class="col-sm-10">
            <span class="p-1">{{ $data->name }}</span>
            <br/>
            <span class="badge badge-primary p-1">{{ $data->email }}</span>
        </div>
    </div>

@endif
