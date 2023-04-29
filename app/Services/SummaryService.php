<?php

namespace App\Services;

use App\Enums\InvoiceStatusEnum;
use App\Enums\ProductStatusEnum;
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

    public function __construct(Product $product, Transaction $transaction, User $user)
    {
        $this->product = $product;
        $this->transaction = $transaction;
        $this->user = $user;
        Xendit::setApiKey(config('xendit.secret_key'));
    }

    /**
     * Handle get balance from xendit
     *
     * @return int
     * @throws ApiException
     */
    public function handleBalance(): int
    {
        return Balance::getBalance('CASH')['balance'];
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
            'labels' => DateHelper::getAllMonths(5),
            'series' => [0, 0, 0, 0, 0, 0]
        ];

        $startDate = DateHelper::getSomeMonthsAgoFromNow(5)->format('Y-m-d H:i:s');
        $endDate = DateHelper::getCurrentTimestamp('Y-m-d H:i:s');

        $datas = $this->transaction->hasLineChart($startDate, $endDate);

        foreach ($datas as $data) {
            $parse = Carbon::parse($data->created_at);
            $date = $parse->shortMonthName . ' ' . $parse->year;
            $index = array_search($date, array_values($result['labels']));
            $result['series'][$index] = (int)$data->total_amount;
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
            ->take(10)
            ->get();
    }

    /**
     * Handle best seller products
     *
     * @return object
     */

    public function handleBestSeller(): object
    {
        $data = $this->product->query()
            ->selectRaw('products.name, products.id, products.photo, products.status, SUM(tc.paid_amount) AS total, COUNT(tc.id) AS transactions_count, products.category_id, dt.product_id, dt.transaction_id, tc.id')
            ->leftJoin('detail_transactions as dt', 'dt.product_id', '=', 'products.id')
            ->leftJoin('transactions as tc', 'tc.id', '=', 'dt.transaction_id')
            ->whereIn('tc.invoice_status', [InvoiceStatusEnum::SETTLED->value, InvoiceStatusEnum::PAID->value])
            ->with(['category'])
            ->groupBy('products.name')
            ->take(10)
            ->orderByDesc('transactions_count')
            ->get();

        return $data->filter(fn($item) => $item->transactions_count > 0);
    }
}
