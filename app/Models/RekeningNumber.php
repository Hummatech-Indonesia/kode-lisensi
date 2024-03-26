<?php

namespace App\Models;

use App\Base\Interfaces\HasBalanceWithdrawals;
use App\Base\Interfaces\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RekeningNumber extends Model implements HasUser, HasBalanceWithdrawals
{
    use HasFactory;
    public $incrementing = false;
    public $fillable = ['id', 'user_id', 'name', 'rekening', 'rekening_number', 'status'];
    public $keyType = 'char';
    protected $table = 'rekening_numbers';
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

    /**
     * balanceWithdrawals
     *
     * @return HasMany
     */
    public function balanceWithdrawals(): HasMany
    {
        return $this->hasMany(BalanceWithdrawal::class);
    }
}
