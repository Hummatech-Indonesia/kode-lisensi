<?php

namespace App\Models;

use App\Base\Interfaces\HasDetailTransaction;
use App\Base\Interfaces\HasOneLicense;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model implements HasOneLicense, HasDetailTransaction
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
}
