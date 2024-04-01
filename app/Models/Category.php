<?php

namespace App\Models;

use App\Base\Interfaces\HasProducts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model implements HasProducts
{
    use HasFactory;

    public $incrementing = false;
    public $fillable = ['id', 'name', 'icon', 'slug'];
    public $keyType = 'char';
    protected $table = 'categories';
    protected $primaryKey = 'id';

    /**
     * One-to-Many relationship with Product Model
     *
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
