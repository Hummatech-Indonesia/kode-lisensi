<?php

namespace App\Services;

use App\Http\Requests\TransactionWhatsappRequest;
use App\Mail\SendLicenseMail;
use Illuminate\Foundation\Mix;
use Illuminate\Support\Facades\Mail;


class TransactionWhatsappService
{
    public function sendEmail(array $data, mixed $product, mixed $transaction, TransactionWhatsappRequest $request)
    {
        Mail::to($data['email'])->send(new SendLicenseMail(
            [
                'name' => $data['name'],
                'email' => $data['email'],
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
    }
}
