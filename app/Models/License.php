<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $fillable = ['id', 'product_id', 'username', 'password', 'serial_key', 'is_purchased'];
    public $keyType = 'char';
    protected $table = 'licenses';
    protected $primaryKey = 'id';

}
