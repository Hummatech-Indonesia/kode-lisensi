<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class TripayService
{

    /**
     * Handle generate callback signature from tripay
     *
     * @param Request $request
     * @return string
     */

    public static function handleGenerateCallbackSignature(Request $request): string
    {
        $privateKey = config('tripay.private_key');

        return hash_hmac('sha256', $request->getContent(), $privateKey);
    }

    /**
     * Handle generate signature from tripay
     *
     * @param string $invoice_id
     * @param int $amount
     * @return string
     */

    public function handleGenerateSignature(string $invoice_id, int $amount): string
    {
        $privateKey = config('tripay.private_key');
        $merchantCode = config('tripay.merchant_code');

        return hash_hmac('sha256', $merchantCode . $invoice_id . $amount, $privateKey);
    }

    /**
     * Handle get payment channels from tripay
     *
     * @return Collection
     */

    public function handlePaymentChannels(): Collection
    {
        $res = Http::withToken(config('tripay.api_key'))
            ->get(config('tripay.api_url') . "merchant/payment-channel")
            ->json();

        return collect($res['data'])->groupBy('group');
    }

    /**
     * Handle create transactions to tripay
     *
     * @param array $data
     *
     * @return array
     */

    public function handleCreateTransaction(array $data): array
    {
        return Http::withToken(config('tripay.api_key'))
            ->post(config('tripay.api_url') . "transaction/create", $data)
            ->json();
    }
}
