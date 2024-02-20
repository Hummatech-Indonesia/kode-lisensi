<?php

namespace App\Models;

use App\Base\Interfaces\HasProduct;
use App\Base\Interfaces\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShareProductReseller extends Model implements HasUser, HasProduct
{
    use HasFactory;
    public $incrementing = false;
    public $keyType = 'char';
    public $fillable = ['id', 'user_id', 'product_id', 'code'];
    protected $table = 'share_product_resellers';
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
        return $this->belongsTo(Product::class);
    }
}
