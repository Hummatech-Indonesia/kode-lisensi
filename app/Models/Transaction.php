<?php

namespace App\Models;

use App\Base\Interfaces\HasDetailTransaction;
use App\Base\Interfaces\HasLineChart;
use App\Base\Interfaces\HasOneLicense;
use App\Base\Interfaces\HasUser;
use App\Enums\InvoiceStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Transaction extends Model implements HasOneLicense, HasDetailTransaction, HasUser, HasLineChart
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'invoice_id', 'user_id', 'fee_amount', 'amount', 'invoice_url', 'expiry_date', 'paid_amount', 'paid_at', 'payment_channel', 'payment_method', 'license_status', 'invoice_status', 'license_id'];
    protected $keyType = 'char';

    /**
     * One-to-One relationship with Detail Transaction Model
     *
     * @return HasOne
     */
    public function detail_transaction(): HasOne
    {
        return $this->hasOne(DetailTransaction::class);
    }

    /**
     * One-to-Many relationship with License Model
     *
     * @return BelongsTo
     */
    public function license(): BelongsTo
    {
        return $this->belongsTo(License::class);
    }

    /**
     * Determine if the models has line chart implementation
     *
     * @param string $start_date
     * @param string $end_date
     * @return object
     */

    public function hasLineChart(string $start_date, string $end_date): object
    {
        return self::query()
            ->select(DB::raw('SUM(paid_amount) as total_amount, created_at'))
            ->whereBetween('created_at', [$start_date, $end_date])
            ->whereIn('invoice_status', [InvoiceStatusEnum::PAID->value, InvoiceStatusEnum::SETTLED->value])
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('created_at')
            ->get();
    }

    /**
     * One-to-Many relationship with User Model
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
