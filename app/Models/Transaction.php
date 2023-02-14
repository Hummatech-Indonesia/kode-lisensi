<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'invoice_id', 'user_id', 'fee_amount', 'amount', 'invoice_url', 'expiry_date', 'paid_amount', 'paid_at', 'payment_channel', 'payment_method', 'invoice_status'];
    protected $keyType = 'char';
}
