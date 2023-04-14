@if($data->is_purchased == 0)
    <td>
        <a
            style="width: 30%"
            data-toggle="modal"
            data-target="#exampleModal"
            data-id='{{ $data->id }}'
            class="btn btn-danger delete">Hapus</a>
    </td>
@endif

