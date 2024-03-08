<ul>
    <li>
        <a class="text-primary" href="{{ route('products.show', $data->id) }}" title="lihat produk">
            <i class="ri-eye-line"></i>
        </a>
    </li>
    <li>
        <a class="text-warning" href="{{ route('products.edit', $data->id) }}" title="edit produk">
            <i class="ri-pencil-line"></i>
        </a>
    </li>
    <li>
        <a href="#" data-toggle="modal" data-target="#exampleModal" data-id='{{ $data->id }}'
            class="text-danger delete-alert" title="hapus produk"><i class="ri-delete-bin-line"></i></a>
    </li>
    <li>
        <a href="#" data-toggle="modal" data-target="#softModal" data-id='{{ $data->id }}'
            class="text-warning delete-soft" title="arsipkan produk"><i class="ri-archive-line"></i></a>
    </li>
</ul>
