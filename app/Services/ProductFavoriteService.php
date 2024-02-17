<?php

namespace App\Services;

use App\Base\Interfaces\uploads\ShouldHandleFileUpload;
use App\Contracts\Interfaces\Products\ProductInterface;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Pagination\Cursor;

class ProductFavoriteService implements ShouldHandleFileUpload
{
    use UploadTrait;

    private ProductInterface $product;

    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }

    /**
     * Handle count license stock from models.
     *
     * @param Request $request
     * @return array
     */

    public function handleProductFilters(Request $request): array
    {
        $nextCursor = $request->query('nextCursor') ? Cursor::fromEncoded($request->query('nextCursor')) : null;

        $request->merge(['user_id' => auth()->user()->id]);
        $products = $this->product->cursorPaginate(15, ['*'], 'cursor', $nextCursor, $request);

        if ($products->hasMorePages()) $nextCursor = $products->nextCursor()->encode();

        return [
            'products' => $products,
            'nextCursor' => $nextCursor
        ];
    }
}
