<?php

namespace App\Models;

use App\Base\Interfaces\HasCategory;
use App\Base\Interfaces\HasLicenses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements HasCategory, HasLicenses
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    public $fillable = ['id', 'category_id', 'status', 'type', 'name', 'photo', 'buy_price', 'sell_price', 'discount', 'reseller_discount', 'description', 'installation', 'attachment_file'];
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
}
