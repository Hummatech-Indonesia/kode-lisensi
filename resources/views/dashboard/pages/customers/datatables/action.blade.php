<ul>
    <li>
        <a href="#" data-toggle="modal" data-target="#updateUser" data-id='{{ $data->id }}' data-name='{{$data->name}}' data-email='{{$data->email}}' data-phone-number='{{$data->phone_number}}'
            class="text-danger update-alert" title="update produk"><i class="ri-pencil-line"></i></a>
    </li>
    <li>
        <a href="#" data-toggle="modal" data-target="#exampleModal" data-id='{{ $data->id }}'
            class="text-danger delete-alert" title="hapus produk"><i class="ri-delete-bin-line"></i></a>
    </li>
</ul>
