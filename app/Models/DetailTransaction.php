<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'detail_transactions';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'transaction_id', 'product_id', 'name', 'phone_number', 'email'];
    protected $keyType = 'char';
}
