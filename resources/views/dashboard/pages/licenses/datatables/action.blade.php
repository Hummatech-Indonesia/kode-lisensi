@if($data->is_purchased == 0)
    <ul>
        <li>
            <a href="#"
               id="btnDeleteLicense"
               data-id='{{ $data->id }}'
               class="btn text-danger delete-alert"><i class="ri-delete-bin-line"></i></a>
        </li>
    </ul>

@endif

