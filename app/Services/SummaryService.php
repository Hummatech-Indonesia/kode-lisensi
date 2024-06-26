<?php

namespace App\Services;

use App\Enums\InvoiceStatusEnum;
use App\Enums\ProductStatusEnum;
use App\Enums\RatingStatusEnum;
use App\Helpers\DateHelper;
use App\Helpers\ProductHelper;
use App\Helpers\UserHelper;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Xendit\Balance;
use Xendit\Exceptions\ApiException;
use Xendit\Xendit;

class SummaryService
{
    private Product $product;
    private Transaction $transaction;

    public function __construct(Product $product, Transaction $transaction)
    {
        $this->product = $product;
        $this->transaction = $transaction;
    }

    /**
     * productRecommendations
     *
     * @return mixed
     */
    public function productRecommendations(): mixed
    {
        return $this->product->query()
            ->where('product_recommendation', 1)
            ->withCount([
                'product_ratings',
                'licenses' => function ($query) {
                    return $query->where('is_purchased', 0);
                }
            ])
            ->take(8)
            ->get();
    }

    /**
     * Handle count total orders
     *
     * @return int
     */

    public function handleCountOrders(): int
    {
        return $this->transaction->query()
            ->whereIn('invoice_status', [InvoiceStatusEnum::PAID->value, InvoiceStatusEnum::SETTLED->value])
            ->count();
    }

    /**
     * Handle count all products
     *
     * @return int
     */

    public function handleCountProducts(): int
    {
        return ProductHelper::countProducts();
    }

    /**
     * Handle count all customers
     *
     * @return int
     */

    public function handleCountCustomers(): int
    {
        return UserHelper::countCustomers() + UserHelper::countResellers();
    }


    /**
     * Handle get the lowest stock products
     *
     * @return object
     */

    public function handleLowStockProducts(): object
    {
        return $this->product->query()
            ->with('category')
            ->withCount([
                'licenses as licenses_count' => function ($query) {
                    $query->where('is_purchased', 0);
                }
            ])
            ->oldest('licenses_count')
            ->where('status', ProductStatusEnum::AVAILABLE->value)
            ->take(10)
            ->get();
    }

    /**
     * Handle make pie chart.
     *
     * @return array
     */

    public function handlePieChart(): array
    {
        return [
            'labels' => ['Stocking', 'Preorder'],
            'series' => [
                ProductHelper::countStockingProducts(),
                ProductHelper::countPreorderProducts()
            ]
        ];
    }

    /**
     * Handle make line chart
     *
     * @return array
     */

    public function handleLineChart(): array
    {
        $result = [
            'labels' => DateHelper::getAllMonths(4),
            'series' => [0, 0, 0, 0, 0, 0]
        ];

        $startDate = DateHelper::getSomeMonthsAgoFromNow(4)->format('Y-m-d H:i:s');
        $endDate = DateHelper::getCurrentTimestamp('Y-m-d H:i:s');

        $datas = $this->transaction->hasLineChart($startDate, $endDate);

        foreach ($datas as $data) {
            $parse = Carbon::parse($data->created_at);
            $date = $parse->shortMonthName . ' ' . $parse->year;
            $index = array_search($date, array_values($result['labels']));
            $result['series'][$index] = (int) $data->total_amount;
        }

        return $result;
    }

    /**
     * Handle latest transaction
     *
     * @return object
     */

    public function handleLatestTransaction(): object
    {
        return $this->transaction->query()
            ->with(['user', 'detail_transaction.product'])
            ->whereHas('detail_transaction.product')
            ->take(10)
            ->latest()
            ->get();
    }

    /**
     * Handle best seller products
     *
     * @param int $take
     * @return object
     */

    public function handleBestSeller(int $take = 5): object
    {
        $data = $this->product->query()
            ->selectRaw('products.name, products.slug, products.id AS product_id, products.photo, products.status, products.sell_price, products.discount, products.reseller_discount, SUM(tc.paid_amount) AS total, COUNT(tc.id) AS transactions_count, products.category_id, dt.product_id, dt.transaction_id, tc.id')
            ->leftJoin('detail_transactions as dt', 'dt.product_id', '=', 'products.id')
            ->leftJoin('transactions as tc', 'tc.id', '=', 'dt.transaction_id')
            ->whereIn('tc.invoice_status', [InvoiceStatusEnum::SETTLED->value, InvoiceStatusEnum::PAID->value])
            ->with(['category', 'varianProducts'])
            ->withCount('product_ratings')
            ->withSum([
                'product_ratings' => function ($query) {
                    $query->where('status', RatingStatusEnum::APPROVED->value);
                }
            ], 'rating')
            ->groupBy('products.name')
            ->take($take)
            ->orderByDesc('transactions_count')
            ->get();

        return $data;
    }

    /**
     * handleBestSellerPage
     *
     * @param  mixed $take
     * @return object
     */
    public function handleBestSellerPage(int $take = 5): object
    {
        $data = $this->product->query()
            ->whereHas('detailTransactions', function ($query) {
                $query->whereHas('transaction', function ($query) {
                    $query->whereIn('invoice_status', [InvoiceStatusEnum::SETTLED->value, InvoiceStatusEnum::PAID->value]);
                });
            })
            ->withCount([
                'product_ratings',
                'licenses' => function ($query) {
                    return $query->where('is_purchased', 0);
                }
            ])
            ->with(['category', 'varianProducts'])
            ->withCount('product_ratings')
            ->withCount('transactions')
            ->withSum([
                'product_ratings' => function ($query) {
                    $query->where('status', RatingStatusEnum::APPROVED->value);
                }
            ], 'rating')
            ->groupBy('products.name')
            ->take($take)
            ->orderByDesc('transactions_count')
            ->get();

        return $data;
    }

    /**
     * Handle the highest ratings products
     *
     * @param int $take
     * @return object
     */

    public function handleHighestRatings(int $take): object
    {
        $data = $this->product->query()
            ->select('id', 'category_id', 'status', 'type', 'name', 'photo', 'sell_price', 'discount', 'reseller_discount', 'slug')
            ->with('category')
            ->withCount('product_ratings')
            ->withCount([
                'product_ratings',
                'licenses' => function ($query) {
                    return $query->where('is_purchased', 0);
                }
            ])
            ->withSum([
                'product_ratings' => function ($query) {
                    $query->where('status', RatingStatusEnum::APPROVED->value);
                }
            ], 'rating')
            ->take($take)
            ->orderByDesc('product_ratings_sum_rating')
            ->get();

        return $data->filter(fn($item) => $item->product_ratings_sum_rating != null);
    }

    /**
     * Handle latest's products
     *
     * @param int $take
     * @return object
     */

    public function handleLatestProducts(int $take = 15): object
    {
        return $this->product->query()
            ->select('id', 'category_id', 'status', 'type', 'name', 'photo', 'sell_price', 'discount', 'reseller_discount', 'slug', 'created_at', 'discount_price')
            ->with(['category', 'varianProducts'])
            ->withCount([
                'product_ratings',
                'licenses' => function ($query) {
                    return $query->where('is_purchased', 0);
                }
            ])
            ->withSum([
                'product_ratings' => function ($query) {
                    $query->where('status', RatingStatusEnum::APPROVED->value);
                }
            ], 'rating')
            ->take($take)
            ->latest()
            ->get();
    }

    /**
     * handleLatestProducts
     *
     * @param  mixed $take
     * @return object
     */
    public function handleLatestProductNotReccomendation(int $take = 15): object
    {
        return $this->product->query()
            ->select('id', 'category_id', 'status', 'type', 'name', 'photo', 'sell_price', 'discount', 'reseller_discount', 'slug', 'created_at')
            ->with(['category', 'varianProducts'])
            ->withCount([
                'product_ratings',
                'licenses' => function ($query) {
                    return $query->where('is_purchased', 0);
                }
            ])
            ->withSum([
                'product_ratings' => function ($query) {
                    $query->where('status', RatingStatusEnum::APPROVED->value);
                }
            ], 'rating')
            ->take($take)
            ->latest()
            ->get();
    }
    /**
     * handleLatestProducts
     *
     * @param  mixed $take
     * @return object
     */
    public function handleLatestProductNotBestSeller(int $take = 15): object
    {
        return $this->product->query()
            ->select('id', 'category_id', 'status', 'type', 'name', 'photo', 'sell_price', 'discount', 'reseller_discount', 'slug', 'created_at', 'discount_price')
            ->with(['category', 'varianProducts'])
            ->withCount([
                'product_ratings',
                'licenses' => function ($query) {
                    return $query->where('is_purchased', 0);
                }
            ])
            ->whereDoesntHave('transactions')
            ->withSum([
                'product_ratings' => function ($query) {
                    $query->where('status', RatingStatusEnum::APPROVED->value);
                }
            ], 'rating')
            ->take($take)
            ->latest()
            ->get();
    }
    /**
     * handleLatestProductNotRating
     *
     * @param  mixed $take
     * @return object
     */
    public function handleLatestProductNotRating(int $take = 15): object
    {
        return $this->product->query()
            ->select('id', 'category_id', 'status', 'type', 'name', 'photo', 'sell_price', 'discount', 'reseller_discount', 'slug', 'created_at', 'discount_price')
            ->with(['category', 'varianProducts'])
            ->withCount([
                'product_ratings',
                'licenses' => function ($query) {
                    return $query->where('is_purchased', 0);
                }
            ])
            ->whereDoesntHave('product_ratings')
            ->withSum([
                'product_ratings' => function ($query) {
                    $query->where('status', RatingStatusEnum::APPROVED->value);
                }
            ], 'rating')
            ->take($take)
            ->latest()
            ->get();
    }

    /**
     * Handle recommended products
     *
     * @param int $take
     * @return object
     */

    public function handleRecommendProducts(int $take, mixed $product): object
    {
        return $this->product->query()
            ->whereNot('slug', $product->slug)
            ->select('id', 'category_id', 'status', 'type', 'name', 'photo', 'sell_price', 'discount', 'reseller_discount', 'slug', 'created_at', 'discount_price')
            ->with('category')
            ->withCount(['product_ratings', 'licenses'])
            ->withSum([
                'product_ratings' => function ($query) {
                    $query->where('status', RatingStatusEnum::APPROVED->value);
                }
            ], 'rating')
            ->take($take)
            ->inRandomOrder()
            ->get();
    }

    /**
     * Handle same category products
     *
     * @param string $product_id
     * @param int $category_id
     * @param int $take
     * @return object
     */
    public function handleSameCategoryProducts(string $product_id, int $category_id, int $take = 15): object
    {
        return $this->product->query()
            ->select('id', 'category_id', 'status', 'type', 'name', 'photo', 'sell_price', 'discount', 'reseller_discount', 'slug', 'created_at', 'discount_price')
            ->where('category_id', $category_id)
            ->whereNot('id', $product_id)
            ->with('category')
            ->withCount(['product_ratings', 'licenses'])
            ->withSum([
                'product_ratings' => function ($query) {
                    $query->where('status', RatingStatusEnum::APPROVED->value);
                }
            ], 'rating')
            ->take($take)
            ->latest()
            ->get();
    }
}
