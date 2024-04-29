<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Administrator\TransactionWhatsappInterface;
use App\Contracts\Interfaces\Products\ProductInterface;
use App\Contracts\Interfaces\TransactionInterface;
use App\Contracts\Interfaces\UpdateIdInvoiceInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Contracts\Interfaces\VarianProductInterface;
use App\Enums\InvoiceStatusEnum;
use App\Enums\LicenseStatusEnum;
use App\Enums\UserRoleEnum;
use App\Helpers\CurrencyHelper;
use App\Http\Requests\TransactionWhatsappRequest;
use App\Services\TransactionWhatsappService;
use Faker\Provider\Uuid;
use Illuminate\Http\RedirectResponse;

class TransactionWhatsappController extends Controller
{
    private TransactionWhatsappInterface $transactionWhatsapp;
    private ProductInterface $product;
    private TransactionInterface $transaction;
    private UserInterface $user;
    private UpdateIdInvoiceInterface $updateIdInvoice;
    private VarianProductInterface $varianProduct;
    private TransactionWhatsappService $transactionWhatsappService;


    public function __construct(TransactionWhatsappInterface $transactionWhatsapp, UserInterface $user, ProductInterface $product, UpdateIdInvoiceInterface $updateIdInvoice, TransactionInterface $transaction, VarianProductInterface $varianProduct, TransactionWhatsappService $transactionWhatsappService)
    {
        $this->transactionWhatsapp = $transactionWhatsapp;
        $this->product = $product;
        $this->varianProduct = $varianProduct;
        $this->user = $user;
        $this->transaction = $transaction;
        $this->transactionWhatsappService = $transactionWhatsappService;
        $this->updateIdInvoice = $updateIdInvoice;
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(TransactionWhatsappRequest $request, string $slug = null, string $slug_varian = null): RedirectResponse
    {
        $data = $request->validated();
        $user = $this->user->searchByEmail($data['email']);

        if ($user == null) {
            $user = $this->user->store([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt('password'),
                'role' => $data['role'],
                'phone_number' => $data['phone_number'],
                'email_verified_at' => now(),
            ]);

            $user->assignRole($data['role']);
        }

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

        $product = $this->product->getWhere(['slug' => $slug, 'slug_varian' => $slug_varian]);
        $data['product_id'] = $product->id;
        $data['user_id'] = $user->id;
        $data['id'] = Uuid::uuid();
        $data['invoice_id'] = $external_id;
        $data['invoice_status'] = InvoiceStatusEnum::PAID->value;
        $data['order_via_whatsapp'] = 1;
        $data['license_status'] = LicenseStatusEnum::COMPLETED->value;

        if ($data['role'] == UserRoleEnum::CUSTOMER->value) {
            if ($slug_varian) {
                $amount = CurrencyHelper::countPriceAfterDiscount($product->varianProducts[0]->sell_price, $product->discount,false,$product->discount_price);
            } else {
                $amount = CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->discount,false,$product->discount_price);
            }
            $data['amount'] = $amount + $amount * 0.1;
        } else {
            if ($slug_varian) {
                $amount =  CurrencyHelper::countPriceAfterDiscount($product->varianProducts[0]->sell_price, $product->reseller_discount,false,$product->discount_price);
            } else {
                $amount =  CurrencyHelper::countPriceAfterDiscount($product->sell_price, $product->reseller_discount,false,$product->discount_price);
            }
            $data['amount'] = $amount + $amount * 0.1;
        }
        if ($slug_varian) {
            $varianProduct = $this->varianProduct->getWhere(['product_id' => $product->id, 'slug_varian' => $slug_varian]);
            $data['varian_product_id'] = $varianProduct->id;
        } else {
            $varianProduct = null;
        }
        $data['paid_amount'] = $amount + $amount * 0.1;

        $transaction = $this->transactionWhatsapp->store($data);

        $this->transactionWhatsappService->sendEmail($data, $product, $transaction, $request);

        return to_route('orders.history')->with('success', trans('alert.add_success'));
    }
}
