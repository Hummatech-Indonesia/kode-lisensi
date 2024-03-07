<ul>
    <li>
        <a class="text-primary" href="{{ route('products.show', $data->id) }}"
           title="">
            <i class="ri-eye-line"></i>
        </a>
    </li>
    <li>
        <a href="#"
           data-toggle="modal"
           data-target="#exampleModal"
           data-id='{{ $data->id }}'
           class="text-danger delete-alert"><i
                class="ri-delete-bin-line"></i></a>
    </li>
    <li> 
        <a href="#"
           data-toggle="modal"
           data-target="#softModal"
           data-id='{{ $data->id }}'
           class="text-warning delete-soft"><i
                class="ri-archive-line"></i></a>
    </li>
</ul>
