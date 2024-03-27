<?php

namespace App\Models;

use App\Base\Interfaces\HasRekeningNumber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BalanceWithdrawal extends Model implements HasRekeningNumber
{
    use HasFactory;
    public $incrementing = false;
    public $fillable = ['rekening_number_id', 'balance', 'proof', 'status'];
    public $keyType = 'char';
    protected $table = 'balance_withdrawals';
    protected $primaryKey = 'id';

    /**
     * rekeningNumber
     *
     * @return BelongsTo
     */
    public function rekening_number(): BelongsTo
    {
        return $this->belongsTo(RekeningNumber::class);
    }
}
