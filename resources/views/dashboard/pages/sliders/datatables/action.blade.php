<div class="flex gap-2">
    <a href="{{ route('slider.edit', $data->id) }}"><i class="ri ri-pencil-line"></i></a>
    <a type="button" class="text-danger delete-alert" data-bs-toggle="modal" data-bs-target="#deleteSliderModal"
        data-id="{{ $data->id }}">
        <i class="ri-delete-bin-line"></i>
    </a>
</div>
