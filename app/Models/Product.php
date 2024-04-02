<?php

namespace App\Models;

use App\Base\Interfaces\HasCategory;
use App\Base\Interfaces\HasDetailTransactions;
use App\Base\Interfaces\HasLicenses;
use App\Base\Interfaces\HasOneProductEmail;
use App\Base\Interfaces\HasProductFavorites;
use App\Base\Interfaces\HasProductQuestions;
use App\Base\Interfaces\HasProductRecommendations;
use App\Base\Interfaces\HasRatings;
use App\Base\Interfaces\HasTransactions;
use App\Base\Interfaces\HasVarianProducts;
use App\Traits\ScopeSearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements HasCategory, HasLicenses, HasProductQuestions, HasRatings, HasTransactions, HasProductFavorites, HasVarianProducts, HasOneProductEmail, HasDetailTransactions, HasProductRecommendations
{
    use HasFactory, SoftDeletes, ScopeSearchTrait;

    public $incrementing = false;
    public $fillable = ['id', 'category_id', 'status', 'type', 'name', 'photo', 'buy_price', 'sell_price', 'discount', 'reseller_discount', 'description', 'short_description', 'features', 'installation', 'attachment_file', 'slug', 'discount_price'];
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
     * product_recommendations
     *
     * @return HasMany
     */
    public function product_recommendations(): HasMany
    {
        return $this->hasMany(ProductRecommendation::class);
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
     * varianProducts
     *
     * @return HasMany
     */
    public function varianProducts(): HasMany
    {
        return $this->hasMany(VarianProduct::class)->orderBy('sell_price');
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
     * One-to-Many relationship with Product Testimonials Model
     *
     * @return HasMany
     */
    public function product_ratings(): HasMany
    {
        return $this->hasMany(ProductTestimonial::class);
    }

    /**
     * One-to-Many relationship with Transaction Model
     *
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(DetailTransaction::class);
    }
    /**
     * product_favorites
     *
     * @return HasMany
     */
    public function product_favorites(): HasMany
    {
        return $this->hasMany(ProductFavorite::class);
    }

    /**
     * Get all of the productEmails for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productEmail(): HasOne
    {
        return $this->hasOne(ProductEmail::class);
    }


    /**
     * Get all of the detailTransactions for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailTransactions(): HasMany
    {
        return $this->hasMany(DetailTransaction::class);
    }
}
