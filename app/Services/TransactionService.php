<?php

namespace App\Services;

use App\Contracts\Interfaces\LicenseInterface;
use App\Contracts\Interfaces\TransactionInterface;
use App\Enums\ProductStatusEnum;
use App\Enums\UserRoleEnum;
use App\Helpers\CurrencyHelper;
use App\Helpers\UserHelper;
use App\Http\Requests\TransactionRequest;
use App\Jobs\TransactionJob;
use App\Models\Product;
use Faker\Provider\Uuid;
use Xendit\Invoice;
use Xendit\Xendit;

class TransactionService
{
    private TransactionInterface $transaction;
    private LicenseInterface $license;

    public function __construct(TransactionInterface $transaction, LicenseInterface $license)
    {
        $this->transaction = $transaction;
        $this->license = $license;

        Xendit::setApiKey(config('xendit.secret_key'));
    }

    /**
     * Handle check product type & stock.
     *
     * @param Product $product
     * @return bool
     */

    public function checkProductType(Product $product): bool
    {
        return !(($product->status === ProductStatusEnum::AVAILABLE->value && $product->licenses_count <= 0));
    }

    /**
     * Handle checkout.
     *
     * @param TransactionRequest $request
     * @param Product $product
     * @return void
     */

    public function handleCheckout(TransactionRequest $request, Product $product): void
    {
        $data = $request->validated();
        $external_id = "invoice-" . Uuid::uuid();
        $license = $this->license->get();
        $discount = (UserHelper::getUserRole() === UserRoleEnum::RESELLER->value) ? $product->reseller_discount : $product->discount;
        $price = CurrencyHelper::countPriceAfterDiscount($product->sell_price, $discount);
        $fee = CurrencyHelper::countProductTax($price, 10);
        $amount = CurrencyHelper::countPriceAfterTax($price, 10);

        $createInvoice = Invoice::create([
            'external_id' => $external_id,
            'amount' => $amount,
            'payer_email' => $data['email'],
            'fixed_va' => false,
            'should_send_email' => false,
            'invoice_duration' => 1800,
            'success_redirect_url' => config('app.url') . "checkout/" . $external_id . "/success",
            'failure_redirect_url' => config('app.url') . "checkout/" . $external_id . "/failed",
            'description' => 'Pembelian ' . $product->name . ". " . trans('alert.fees_notification'),
            'customer' => [
                'given_names' => $data['name'],
                'email' => $data['email']
            ],
            'items' => [
                [
                    'name' => $product->name,
                    'quantity' => 1,
                    'price' => $price,
                    'category' => $product->category->name,
                    'url' => config('app.url') . "products/" . $product->slug
                ]
            ],
            'fees' => [
                [
                    'type' => 'Pajak 10%',
                    'value' => $fee
                ]
            ]
        ]);

        $license_id = ($product->status === ProductStatusEnum::PREORDER->value) ? null : $license->id;

        $transaction = $this->transaction->store($createInvoice + ['license_id' => $license_id]);

        $transaction->detail_transaction()->create([
            'id' => Uuid::uuid(),
            'transaction_id' => $transaction['id'],
            'product_id' => $product->id,
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email']
        ]);

        if ($license_id) $this->license->update($license->id, ['is_purchased' => 1]);

        dispatch(new TransactionJob([
            'name' => $data['name'],
            'email' => $data['email'],
            'url' => $createInvoice['invoice_url'],
            'pack_name' => $product->name,
            'pack_price' => $price,
            'quantity' => 1,
            'fees' => $fee,
            'total_amount' => $createInvoice['amount'],
            'expired_date' => $createInvoice['expiry_date']
        ]));

    }
}
