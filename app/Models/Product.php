<?php

namespace App\Models;

use App\Base\Interfaces\HasCategory;
use App\Base\Interfaces\HasLicenses;
use App\Base\Interfaces\HasProductQuestions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements HasCategory, HasLicenses, HasProductQuestions
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    public $fillable = ['id', 'category_id', 'status', 'type', 'name', 'photo', 'buy_price', 'sell_price', 'discount', 'reseller_discount', 'description', 'installation', 'attachment_file', 'slug'];
    public $keyType = 'char';
    protected $table = 'products';
    protected $primaryKey = 'id';

    /**
     * One-to-Many relationship with Category Model
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * One-to-Many relationship with License Model
     *
     * @return HasMany
     */
    public function licenses(): HasMany
    {
        return $this->hasMany(License::class);
    }

    /**
     * One-to-Many relationship with Product Questions Model
     *
     * @return HasMany
     */

    public function product_questions(): HasMany
    {
        return $this->hasMany(ProductQuestion::class);
    }

    /**
     * Scope a query to search with where
     *
     * @param mixed $query
     * @param mixed $column
     * @param mixed $value
     *
     * @return Builder
     */

    public function scopeOrWhereLike(mixed $query, mixed $column, mixed $value): Builder
    {
        return $query->orWhere($column, 'like', '%' . $value . '%');
    }

}
