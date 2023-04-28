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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Xendit\Invoice;
use Xendit\Xendit;

class CallbackService
{
    private LicenseInterface $license;

    public function __construct(LicenseInterface $license)
    {
        $this->license = $license;
        Xendit::setApiKey(config('xendit.secret_key'));
    }

    /**
     * Handle Retrieve invoice from xendit.
     *
     * @param string $id
     * @return array
     */

    public function handleRetrieveInvoiceFromXendit(string $id): array
    {
        return Invoice::retrieve($id);
    }

    /**
     * Handle Paid Invoice.
     *
     * @param array $find
     * @param object $data
     * @return void
     */

    public function handlePaidInvoice(array $find, object $data): void
    {
        if (in_array($find['status'], [InvoiceStatusEnum::PAID->value, InvoiceStatusEnum::SETTLED->value])) {

            $license_relation = $data->license;
            $product_relation = $data->license->product;
            $product_status = $product_relation->status;
            $paid_at = Carbon::parse($find['paid_at'])->format('Y-m-d H:m:s');
            $buyer = UserHelper::instantGetUser($data->user_id);

            $license_status = (ProductStatusEnum::AVAILABLE->value === $product_status) ? LicenseStatusEnum::COMPLETED->value : LicenseStatusEnum::PROCESSED->value;

            $data->update([
                'paid_amount' => $find['paid_amount'],
                'paid_at' => $paid_at,
                'payment_channel' => $find['payment_channel'],
                'payment_method' => $find['payment_method'],
                'license_status' => $license_status,
                'invoice_status' => $find['status']
            ]);

            Mail::to($find['customer']['email'])->send(new PaidInvoiceMail(
                [
                    'name' => $find['customer']['given_names'],
                    'email' => $find['customer']['email'],
                    'invoice_id' => $find['external_id'],
                    'pack_name' => $find['items'][0]['name'],
                    'pack_price' => $find['items'][0]['price'],
                    'quantity' => $find['items'][0]['quantity'],
                    'total_amount' => $find['paid_amount'],
                    'payment_channel' => $find['payment_channel'],
                    'payment_method' => $find['payment_method'],
                    'paid_at' => $paid_at,
                    'product_status' => $product_status,
                    'product_type' => $product_relation->type,
                    'attachment_file' => $product_relation->attachment_file,
                    'licenses' => [
                        'username' => $license_relation->username,
                        'password' => $license_relation->password,
                        'serial_key' => $license_relation->serial_key
                    ]
                ]
            ));

            Notification::send($buyer, new DashboardNotification([
                'name' => trans('notification.user_pack_purchased_title', ['pack_name' => $find['items'][0]['name'], 'price' => $find['items'][0]['price']]),
                'url' => route('users.account.histories.show', $product_relation->slug)
            ]));

            Notification::send(UserHelper::getAllAdministrators(), new DashboardNotification([
                'name' => trans('notification.admin_purchased_title', ['user_name' => $buyer->name, 'pack_name' => $find['items'][0]['name'], 'paid' => CurrencyHelper::rupiahCurrency($find['paid_amount'])]),
                'url' => null
            ]));

            if (ProductStatusEnum::PREORDER->value === $product_status) {
                dispatch(new NotifyPreorderJob([
                    'name' => $find['customer']['given_names'],
                    'email' => config('mail.notify_preorder'),
                    'invoice_id' => $find['external_id'],
                    'pack_name' => $find['items'][0]['name'],
                    'pack_price' => $find['items'][0]['price'],
                    'quantity' => $find['items'][0]['quantity'],
                    'total_amount' => $find['paid_amount'],
                    'payment_channel' => $find['payment_channel'],
                    'payment_method' => $find['payment_method'],
                    'paid_at' => $paid_at,
                    'url' => route('orders.detail', $product_relation->slug),
                ]));
            }

        }
    }

    /**
     * Handle Expired Invoice.
     *
     * @param array $find
     * @param object $data
     * @return void
     */

    public function handleExpiredInvoice(array $find, object $data): void
    {
        if (in_array($find['status'], [InvoiceStatusEnum::EXPIRED->value, InvoiceStatusEnum::FAILED->value])) {

            $data->update([
                'license_status' => LicenseStatusEnum::CANCELED->value,
                'invoice_status' => $find['status'],
                'license_id' => null
            ]);

            $product_relation = $data->license->product;
            $product_status = $product_relation->status;

            $license_id = ($product_status === ProductStatusEnum::PREORDER->value) ? null : $data->license_id;

            if ($license_id) $this->license->update($data->license_id, ['is_purchased' => 0]);

            dispatch(new ExpiredInvoiceJob([
                'name' => $find['customer']['given_names'],
                'email' => $find['customer']['email'],
                'invoice_id' => $find['external_id'],
                'pack_name' => $find['items'][0]['name'],
                'pack_price' => $find['items'][0]['price'],
                'quantity' => $find['items'][0]['quantity'],
                'total_amount' => $find['paid_amount'],
                'created_at' => $find['created']
            ]));

        }
    }
}
