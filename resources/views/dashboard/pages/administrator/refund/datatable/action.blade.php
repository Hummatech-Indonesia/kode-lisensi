<ul>
    @if (request()->routeIs('dashboard.refund.index'))
        <li><a type="button" class="text-success approve-alert" id="approveRefund" data-bs-toggle="modal"
                data-bs-target="#approveRefundModal" data-id="{{ $data->id }}">
                <i class="ri-check-line"></i>
            </a></li>
        <li><a type="button" class="text-danger reject-alert" id="rejectRefund" data-bs-toggle="modal"
                data-bs-target="#rejectRefundModal" data-id="{{ $data->id }}">
                <i class="ri-close-line"></i> </a></li>
    @elseif (request()->routeIs('dashboard.refund.histories'))
        <li><a type="button" class="text-primary detail-alert" id="detailRefund" data-bs-toggle="modal"
                data-bs-target="#detailRefundModal" data-id="{{ $data->id }}"
                data-description="{{ $data->description }}" data-rekening="{{ $data->rekening_number }}"
                data-bank="{{ $data->bank }}" data-username={{ $data->user->name }}
                data-created-at="{{ $data->created_at }}"
                data-product="{{ $data->transaction->detail_transaction->product->name }}"
                data-proof="{{ $data->proof }}">
                <i class="ri-eye-line"></i> </a></li>
    @endif
</ul>
