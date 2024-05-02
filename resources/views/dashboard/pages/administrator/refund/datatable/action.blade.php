<ul>
    <li><a type="button" class="text-success approve-alert" id="approveRefund" data-bs-toggle="modal" data-bs-target="#approveRefundModal"
            data-id="{{ $data->id }}">
            <i class="ri-check-line"></i>
        </a></li>
    <li><a type="button" class="text-danger reject-alert" id="rejectRefund" data-bs-toggle="modal" data-bs-target="#rejectRefundModal"
            data-id="{{ $data->id }}">
            <i class="ri-close-line"></i> </a></li>
</ul>
