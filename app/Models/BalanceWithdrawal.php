<?php

namespace App\Models;

use App\Base\Interfaces\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BalanceWithdrawal extends Model implements HasUser
{
    use HasFactory;
    public $incrementing = false;
    public $fillable = ['user_id', 'via', 'rekening_number', 'balance', 'status'];
    public $keyType = 'char';
    protected $table = 'balance_withdrawals';
    protected $primaryKey = 'id';

    /**
     * user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
