<ul>
    <li><a type="button" class="text-success approve-alert" id="approveRefund" data-bs-toggle="modal" data-bs-target="#approveRefund"
            data-id="{{ $data->id }}">
            <i class="ri-check-line"></i>
        </a></li>
    <li><a type="button" class="text-danger reject-alert" data-bs-toggle="modal" data-bs-target="#rejectRefund"
            data-id="{{ $data->id }}" data-used-for="{{ $data->used_for }}"
            data-balance-used="{{ $data->balance_used }}" data-balance-withdrawn="{{ $data->balance_withdrawn }}"
            data-description="{{ $data->description }}">
            <i class="ri-close-line"></i> </a></li>
</ul>
