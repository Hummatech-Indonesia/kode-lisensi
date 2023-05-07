<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\RatingInterface;
use App\Enums\RatingStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RatingRequest;
use App\Models\ProductTestimonial;
use Illuminate\Http\RedirectResponse;

class ProductTestimonialController extends Controller
{
    private RatingInterface $rating;

    public function __construct(RatingInterface $rating)
    {
        $this->rating = $rating;
    }

    /**
     * Modify Ratings in specific product.
     *
     * @param ProductTestimonial $product_testimonial
     * @return RedirectResponse
     */

    public function modifyRating(ProductTestimonial $product_testimonial): RedirectResponse
    {
        $status = ($product_testimonial->status === RatingStatusEnum::APPROVED->value) ? RatingStatusEnum::DECLINED->value : RatingStatusEnum::APPROVED->value;

        $this->rating->update($product_testimonial->id, ['status' => $status]);

        return back()->with('success', trans('alert.modify_rating'));
    }

    /**
     * Add or Update Rating
     *
     * @param RatingRequest $request
     * @param string $product_id
     * @return RedirectResponse
     */

    public function addOrUpdateRating(RatingRequest $request, string $product_id): RedirectResponse
    {
        $data = $request->validated();

        $query = ProductTestimonial::query()
            ->updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'product_id' => $product_id
                ],
                [
                    'rating' => $data['rating'],
                    'review' => $data['review']
                ]
            );

        $trans = ($query->wasRecentlyCreated === true) ? trans('alert.user_add_rating') : trans('alert.user_update_rating');

        return back()->with('success', $trans);
    }
}
