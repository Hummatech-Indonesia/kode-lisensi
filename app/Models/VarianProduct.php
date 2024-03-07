<?php

namespace App\Models;

use App\Base\Interfaces\HasDetailTransactions;
use App\Base\Interfaces\HasProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VarianProduct extends Model implements HasProduct,HasDetailTransactions
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
        'slug',
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


    /**
     * Get all of the detailTransactions for the VarianProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailTransactions(): HasMany
    {
        return $this->hasMany(DetailTransaction::class);
    }

    /**
     * Get all of the detailTransactionsCount for the VarianProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
}
