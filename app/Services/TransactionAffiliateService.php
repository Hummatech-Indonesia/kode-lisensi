<?php

namespace App\Services;

use App\Contracts\Interfaces\TransactionAffiliateInterface;
use App\Enums\UserRoleEnum;
use App\Helpers\UserHelper;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

class TransactionAffiliateService
{

    private TransactionAffiliateInterface $transactionAffiliate;

    public function __construct(TransactionAffiliateInterface $transactionAffiliate)
    {
        $this->transactionAffiliate = $transactionAffiliate;
    }

    /**
     * store
     *
     * @return mixed
     */
    public function store(Transaction $transaction, mixed $code_affiliate, Product $product, string $slug_varian = null)
    {
        if ($product->varianProducts->first()) {
            $varianProduct = $product->varianProducts->where('slug', $slug_varian)->first();
            $sellPrice = $varianProduct->sell_price;
        } else {
            $sellPrice = $product->sell_price;
        }

        $discount = $product->reseller_discount - $product->discount;
        $discountResult = $sellPrice * $discount / 100;
        $this->transactionAffiliate->store([
            'transaction_id' => $transaction->id,
            'code_affiliate' => $code_affiliate,
            'profit' => $discountResult,
        ]);
    }
}
