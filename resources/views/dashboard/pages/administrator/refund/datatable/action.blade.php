<ul>
    <li><a type="button" class="text-danger delete-alert" data-bs-toggle="modal" data-bs-target="#deleteRefundModal"
            data-id="{{ $data->id }}">
            <i class="ri-delete-bin-line"></i>
        </a></li>
    <li><a type="button" class="text-warning update-alert" data-bs-toggle="modal" data-bs-target="#updateRefundModal"
            data-id="{{ $data->id }}" data-used-for="{{ $data->used_for }}"
            data-balance-used="{{ $data->balance_used }}" data-balance-withdrawn="{{ $data->balance_withdrawn }}"
            data-description="{{ $data->description }}">
            <i class="ri-pencil-line"></i>
        </a></li>
</ul>
