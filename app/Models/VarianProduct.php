<?php

namespace App\Models;

use App\Base\Interfaces\HasProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VarianProduct extends Model implements HasProduct
{
    use HasFactory;
    public $incrementing = false;
    public $keyType = 'char';
    protected $table = 'varian_products';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'product_id',
        'name',
        'buy_price',
        'sell_price',
        'discount',
        'reseller_discount',
    ];
    
    /**
     * product
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
