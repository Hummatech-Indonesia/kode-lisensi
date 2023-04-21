<ul>
    <li>
        <a data-bs-toggle="modal" data-bs-target="#editQuestionModal" class="edit-question" href="#"
           data-id="{{ $data->id }}" data-question="{{ $data->question }}" data-answer="{{ $data->answer }}">
            <i class="ri-pencil-line"></i>
        </a>
    </li>

    <li>
        <a href="#"
           data-id='{{ $data->id }}'
           class="btn text-danger delete-question"><i class="ri-delete-bin-line"></i></a>

    </li>
</ul>
