<?php

namespace App\Models;

use App\Base\Interfaces\HasOneProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class License extends Model implements HasOneProduct
{
    use HasFactory;

    public $incrementing = false;
    public $fillable = ['id', 'product_id', 'username', 'password', 'serial_key','description', 'is_purchased'];
    public $keyType = 'char';
    protected $table = 'licenses';
    protected $primaryKey = 'id';

    /**
     * One-to-Many relationship with Product Model
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
