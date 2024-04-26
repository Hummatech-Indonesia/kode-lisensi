<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $fillable = ['id', 'used_for', 'balance_used','balance_withdrawn', 'description'];
    public $keyType = 'char';

    protected $table = 'expenditures';
    protected $primaryKey = 'id';
}
