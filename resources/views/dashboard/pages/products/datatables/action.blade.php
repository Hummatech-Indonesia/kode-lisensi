<ul>
    @if ($data->product_recommendations->first())
        <li>
            <a data-bs-toggle="modal" data-id="{{ $data->product_recommendations->first()->id }}" data-bs-target="#deleteProductRecommendationModal"
                class="text-primary delete-product-recommendation" title="hapus dari rekomendasi produk">
                <i class="ri-settings-3-fill"></i> </a>
        </li>
    @else
        <li>
            <a data-bs-toggle="modal" data-id="{{ $data->id }}" data-bs-target="#addProductReccomendationModal"
                class="text-primary product-recommendation" title="rekomendasikan produk">
                <i class="ri-arrow-up-fill"></i> </a>
        </li>
    @endif
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
