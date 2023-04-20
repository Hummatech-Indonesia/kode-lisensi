@if($data->is_purchased == 0)
    <td>
        <a href="#"
           id="btnDeleteLicense"
           data-id='{{ $data->id }}'
           class="btn text-danger delete-alert"><i class="ri-delete-bin-line"></i></a>
    </td>
@endif

