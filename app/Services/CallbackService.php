<?php

namespace App\Services;

use App\Contracts\Interfaces\LicenseInterface;
use App\Enums\InvoiceStatusEnum;
use App\Enums\LicenseStatusEnum;
use App\Enums\ProductStatusEnum;
use App\Helpers\CurrencyHelper;
use App\Helpers\UserHelper;
use App\Jobs\ExpiredInvoiceJob;
use App\Jobs\NotifyPreorderJob;
use App\Mail\PaidInvoiceMail;
use App\Notifications\DashboardNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class CallbackService
{
    private LicenseInterface $license;

    public function __construct(LicenseInterface $license)
    {
        $this->license = $license;
    }

    /**
     * Handle Paid Invoice.
     *
     * @param Request $request
     * @param object $data
     * @return void
     */

    public function handlePaidInvoice(Request $request, object $data): void
    {
        if (in_array($request->status, [InvoiceStatusEnum::PAID->value, InvoiceStatusEnum::SETTLED->value])) {

            $license_relation = $data->license;

            $detail = $data->detail_transaction;
            $product_relation = $detail->product;
            $product_status = $product_relation->status;
            $paid_at = Carbon::createFromTimestamp($request->paid_at)->format('Y-m-d H:m:s');

            $buyer = UserHelper::instantGetUser($data->user_id);

            $license_status = (ProductStatusEnum::AVAILABLE->value === $product_status) ? LicenseStatusEnum::COMPLETED->value : LicenseStatusEnum::PROCESSED->value;
            $data->update([
                'paid_amount' => $request->total_amount,
                'paid_at' => $paid_at,
                'payment_channel' => $request->payment_method_code,
                'payment_method' => $request->payment_method,
                'license_status' => $license_status,
                'invoice_status' => $request->status
            ]);

            Mail::to($detail->email)->send(new PaidInvoiceMail(
                [
                    'name' => $detail->name,
                    'email' => $detail->email,
                    'product' => $product_relation,
                    'invoice_id' => $data->invoice_id,
                    'pack_name' => $product_relation->name,
                    'pack_price' => $request->amount_received,
                    'paid_at' => $paid_at,
                    'varian_product' => $detail->varianProduct?->name,
                    'product_status' => $product_status,
                    'product_type' => $product_relation->type,
                    'licenses' => [
                        'username' => ($license_relation) ? $license_relation->username : null,
                        'password' => ($license_relation) ? $license_relation->password : null,
                        'serial_key' => ($license_relation) ? $license_relation->serial_key : null
                    ]
                ]
            ));

            Notification::send($buyer, new DashboardNotification([
                'name' => trans('notification.user_pack_purchased_title', ['pack_name' => $product_relation->name, 'price' => CurrencyHelper::rupiahCurrency($request->amount_received)]),
                'url' => route('users.account.index')
            ]));

            Notification::send(UserHelper::getAllAdministrators(), new DashboardNotification([
                'name' => trans('notification.admin_purchased_title', ['user_name' => $buyer->name, 'pack_name' => $product_relation->name, 'paid' => CurrencyHelper::rupiahCurrency($request->amount_received)]),
                'url' => null
            ]));

            if (ProductStatusEnum::PREORDER->value === $product_status) {
                dispatch(new NotifyPreorderJob([
                    'name' => $detail->name,
                    'email' => config('mail.notify_preorder'),
                    'invoice_id' => $data->invoice_id,
                    'pack_name' => $product_relation->name,
                    'pack_price' => $request->amount_received,
                    'quantity' => 1,
                    'total_amount' => $request->total_amount,
                    'payment_channel' => $request->payment_method_code,
                    'payment_method' => $request->payment_method,
                    'paid_at' => $paid_at,
                    'url' => route('orders.detail', $data->invoice_id),
                ]));
            }
        }
    }

    /**
     * Handle Expired Invoice.
     *
     * @param Request $request
     * @param object $data
     * @return void
     */

    public function handleExpiredInvoice(Request $request, object $data): void
    {
        if (in_array($request->status, [InvoiceStatusEnum::EXPIRED->value, InvoiceStatusEnum::FAILED->value])) {

            $data->update([
                'license_status' => LicenseStatusEnum::CANCELED->value,
                'invoice_status' => $request->status,
                'license_id' => null
            ]);

            $detail = $data->detail_transaction;
            $product_relation = $detail->product;
            $product_status = $product_relation->status;

            $license_id = ($product_status === ProductStatusEnum::PREORDER->value) ? null : $data->license_id;

            if ($license_id) $this->license->update($data->license_id, ['is_purchased' => 0]);

            dispatch(new ExpiredInvoiceJob([
                'name' => $detail->name,
                'email' => $detail->email,
                'invoice_id' => $data->invoice_id,
                'pack_name' => $product_relation->name,
                'pack_price' => $request->amount_received,
                'quantity' => 1,
                'total_amount' => $request->total_amount,
                'created_at' => now()->format('Y-m-d H:m:s')
            ]));
        }
    }
}
