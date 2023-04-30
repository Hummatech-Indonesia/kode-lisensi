<?php

namespace App\Models;

use App\Base\Interfaces\HasOneProduct;
use App\Base\Interfaces\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductTestimonial extends Model implements HasOneProduct, HasUser
{
    use HasFactory;

    public $fillable = ['id', 'user_id', 'product_id', 'rating', 'review', 'status'];
    protected $table = 'product_testimonials';
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

    /**
     * One-to-Many relationship with User Model
     *
     * @return BelongsTo
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
