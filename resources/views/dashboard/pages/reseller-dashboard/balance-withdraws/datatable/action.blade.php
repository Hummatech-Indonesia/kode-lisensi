<ul class="d-flex justify-content-between">
    <li>
        <a class="text-primary approve-withdrawal" data-id="{{ $data->id }}" style="cursor: pointer"
            title="Setujui Penarikan">
            <i class="ri-check-line"></i> </a>
    </li>
    <li>
        <a class="text-danger disapprove-withdrawal" data-id="{{ $data->id }}" style="cursor: pointer"
            title="Tolak Penarikan">
            <i class="ri-close-line"></i> </a>
    </li>
</ul>
