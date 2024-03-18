<?php

namespace App\Services;

use App\Contracts\Interfaces\FcmTokenInterface;
use App\Contracts\Interfaces\LicenseInterface;
use App\Contracts\Interfaces\TransactionInterface;
use App\Contracts\Interfaces\UpdateIdInvoiceInterface;
use App\Contracts\Interfaces\VarianProductInterface;
use App\Enums\LicenseStatusEnum;
use App\Enums\ProductStatusEnum;
use App\Enums\UserRoleEnum;
use App\Helpers\CurrencyHelper;
use App\Helpers\UserHelper;
use App\Http\Requests\TransactionRequest;
use App\Jobs\TransactionJob;
use App\Mail\SendLicenseMail;
use App\Models\Product;
use App\Notifications\OrderNotification;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TransactionService
{
    private TransactionInterface $transaction;
    private LicenseInterface $license;
    private TripayService $service;
    private FcmTokenInterface $fcmToken;
    private VarianProductInterface $varianProduct;
    private UpdateIdInvoiceInterface $updateIdInvoice;

    public function __construct(TransactionInterface $transaction, LicenseInterface $license, TripayService $service, FcmTokenInterface $fcmToken, VarianProductInterface $varianProduct, UpdateIdInvoiceInterface $updateIdInvoice)
    {
        $this->transaction = $transaction;
        $this->license = $license;
        $this->service = $service;
        $this->fcmToken = $fcmToken;
        $this->varianProduct = $varianProduct;
        $this->updateIdInvoice = $updateIdInvoice;
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

    public function handleCheckout(TransactionRequest $request, Product $product, string $slug_varian = null): void
    {
        $data = $request->validated();

        $updateIdInvoice = $this->updateIdInvoice->get();
        $transaction = $this->transaction->getInvoice();
        $getYear = substr(now()->format('Y'), -2);
        if ($updateIdInvoice == null) {
            if ($transaction) {
                $invoice_id = substr($transaction->invoice_id, -4);
                $invoice_id = intval($invoice_id);
                $integer = $invoice_id + 1;
                $length = 4;
                $invoice_id = str_pad(intval($integer), $length, "0", STR_PAD_LEFT);
                $external_id = "KLHM" . $getYear . $invoice_id;
            } else {
                $external_id = "KLHM" . $getYear . "0001";
            }
        } else {
            $external_id = "KLHM" . $getYear . $updateIdInvoice->new_invoice;
            $this->updateIdInvoice->delete($updateIdInvoice->id);
        }

        $license_id = null;
        $discount = (UserHelper::getUserRole() === UserRoleEnum::RESELLER->value) ? $product->reseller_discount : $product->discount;
        if ($slug_varian) {
            $varianProduct = $this->varianProduct->getWhere(['product_id' => $product->id, 'slug_varian' => $slug_varian]);
            $varianProductId = $varianProduct->id;
            $price = CurrencyHelper::countPriceAfterDiscount($varianProduct->sell_price, $discount);
        } else {
            $varianProductId = null;
            $price = CurrencyHelper::countPriceAfterDiscount($product->sell_price, $discount);
        }

        $fee = CurrencyHelper::countProductTax($price, 10);
        $amount = CurrencyHelper::countPriceAfterTax($price, 10);

        $signature = $this->service->handleGenerateSignature($external_id, $amount);

        $pay = [
            'method' => $data['payment_code'],
            'merchant_ref' => $external_id,
            'amount' => $amount,
            'customer_name' => $data['name'],
            'customer_email' => $data['email'],
            'customer_phone' => $data['phone_number'],
            'order_items' => [
                [
                    'name' => $product->name,
                    'sku' => $slug_varian,
                    'price' => $amount,
                    'quantity' => 1,
                    'product_url' => config('app.url') . "products/" . $product->slug,
                    'image_url' => asset('storage/' . $product->photo),
                ]
            ],
            'return_url' => config('app.url') . "checkout/" . $external_id . "/success",
            'expired_time' => (time() + (30 * 60)),
            'signature' => $signature,
        ];

        $createInvoice = $this->service->handleCreateTransaction($pay);

        if ($license = $this->license->getOldest($product->id)) {
            $license_id = ($product->status === ProductStatusEnum::PREORDER->value) ? null : $license->id;
        }

        dd($createInvoice);
        $transaction = $this->transaction->store([
            'id' => $createInvoice['data']['reference'],
            'invoice_id' => $createInvoice['data']['merchant_ref'],
            'fee_amount' => $createInvoice['data']['total_fee'],
            'amount' => $createInvoice['data']['amount_received'],
            'expiry_date' => $createInvoice['data']['expired_time'],
            'payment_channel' => $createInvoice['data']['payment_name'],
            'payment_method' => $createInvoice['data']['payment_method'],
            'invoice_url' => $createInvoice['data']['checkout_url'],
            'license_id' => $license_id
        ]);

        $transaction->detail_transaction()->create([
            'id' => Uuid::uuid(),
            'transaction_id' => $transaction['id'],
            'product_id' => $product->id,
            'name' => $data['name'],
            'note' => $data['note'],
            'varian_product_id' => $varianProductId,
            'phone_number' => $data['phone_number'],
            'email' => $data['email']
        ]);

        $user = $this->fcmToken->get();
        $user->notify(new OrderNotification($product, $transaction));

        if ($license_id) $this->license->update($license->id, ['is_purchased' => 1]);

        dispatch(new TransactionJob([
            'name' => $data['name'],
            'email' => $data['email'],
            'url' => $createInvoice['data']['checkout_url'],
            'pack_name' => $product->name,
            'pack_price' => $price,
            'quantity' => 1,
            'fees' => $fee,
            'total_amount' => $createInvoice['data']['amount'],
            'expired_date' => $createInvoice['data']['expired_time']
        ]));
    }

    /**
     * Handle send preorder licenses.
     *
     * @param TransactionRequest $request
     * @param string $invoice_id
     * @return void
     */

    public function handleSendLicense(Request $request, string $invoice_id): void
    {
        $transaction = $this->transaction->show($invoice_id);
        $product = $transaction->detail_transaction->product;

        Mail::to($transaction->detail_transaction->email)->send(new SendLicenseMail(
            [
                'name' => $transaction->detail_transaction->name,
                'email' => $transaction->detail_transaction->email,
                'product' => $product,
                'varian_product' => $product->varianProduct?->name,
                'invoice_id' => $transaction->invoice_id,
                'pack_name' => $product->name,
                'pack_price' => $product->sell_price,
                'total_amount' => $transaction->paid_amount,
                'payment_method' => $transaction->payment_method,
                'paid_at' => $transaction->paid_at,
                'product_type' => $product->type,
                'created_at' => $transaction->created_at,
                'licenses' => [
                    'username' => $request->username ?? null,
                    'password' => $request->password ?? null,
                    'serial_key' => $request->serial_key ?? null,
                    'description' => $request->description ?? null
                ]
            ]
        ));

        $transaction->update(['license_status' => LicenseStatusEnum::COMPLETED->value]);
    }
}
