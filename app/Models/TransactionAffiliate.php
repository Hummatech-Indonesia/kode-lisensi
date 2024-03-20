<?php

namespace App\Models;

use App\Base\Interfaces\HasTransaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionAffiliate extends Model implements HasTransaction
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'transaction_affiliates';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'transaction_id', 'code_affiliate', 'profit'];
    protected $keyType = 'char';

    /**
     * transaction
     *
     * @return BelongsTo
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}
