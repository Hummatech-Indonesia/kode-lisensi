<ul>
    <li>
        <a href="{{ route('users.edit', $data->id) }}">
            <i class="ri-pencil-line"></i>
        </a>
    </li>

    <li>
        <a href="#" data-toggle="modal" data-target="#exampleModal" data-id='{{ $data->id }}'
            class="text-danger delete-alert"><i class="ri-delete-bin-line"></i></a>
    </li>
</ul>
