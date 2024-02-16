<?php

namespace App\Models;

use App\Base\Interfaces\HasProduct;
use App\Base\Interfaces\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductFavorite extends Model implements HasUser, HasProduct
{
    use HasFactory;
    public $incrementing = false;
    public $fillable = ['id', 'user_id', 'product_id'];
    public $keyType = 'char';
    protected $table = 'product_favorites';
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
     * product
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->product(Product::class);
    }
}
