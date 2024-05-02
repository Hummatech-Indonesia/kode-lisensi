<?php

namespace App\Models;

use App\Base\Interfaces\HasTransaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Refund extends Model implements HasTransaction
{
    use HasFactory;
    public $incrementing = false;
    public $fillable = ['id', 'user_id', 'transaction_id', 'status', 'description', 'proof', 'bank', 'rekening_number', 'rejected'];
    public $keyType = 'char';
    protected $table = 'refunds';
    protected $primaryKey = 'id';

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
