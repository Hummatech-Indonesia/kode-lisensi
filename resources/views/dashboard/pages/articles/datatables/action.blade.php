<ul>
    <li>
        <a class="text-primary" href="{{ route('articles.edit', $data->id) }}"
           title="">
            <i class="ri-edit-line"></i>
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
</ul>
