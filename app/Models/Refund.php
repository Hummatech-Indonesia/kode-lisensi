<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $fillable = ['id', 'transaction_id', 'status', 'description', 'proof', 'bank', 'rekening_number', 'rejected'];
    public $keyType = 'char';
    protected $table = 'refunds';
    protected $primaryKey = 'id';
}
