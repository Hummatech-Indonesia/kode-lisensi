<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $fillable = ['id', 'category_id', 'status', 'type', 'name', 'photo', 'buy_price', 'sell_price', 'discount', 'reseller_discount', 'description', 'installation', 'attachment_file'];
    public $keyType = 'char';
    protected $table = 'products';
    protected $primaryKey = 'id';
}
