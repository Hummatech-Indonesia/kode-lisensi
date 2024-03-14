<?php

namespace App\Models;

use App\Base\Interfaces\HasOneProduct;
use App\Base\Interfaces\HasOneTransaction;
use App\Base\Interfaces\HasVarianProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailTransaction extends Model implements HasOneProduct, HasOneTransaction, HasVarianProduct
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'detail_transactions';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'transaction_id', 'varian_product_id', 'product_id', 'name', 'phone_number', 'email','note'];
    protected $keyType = 'char';

    /**
     * One-to-Many relationship with Product Model
     *
     * @return BelongsTo
     */

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * One-to-Many relationship with Transaction Model
     *
     * @return BelongsTo
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * varianProduct
     *
     * @return BelongsTo
     */
    public function varianProduct(): BelongsTo
    {
        return $this->belongsTo(VarianProduct::class);
    }
}
