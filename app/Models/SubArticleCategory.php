<?php

namespace App\Models;

use App\Base\Interfaces\HasArticleCategory;
use App\Base\Interfaces\HasArticles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubArticleCategory extends Model implements HasArticleCategory, HasArticles
{
    use HasFactory;
    protected $fillable = ['name', 'article_category_id'];

    /**
     * Get the articleCategory that owns the SubArticleCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class);
    }

    /**
     * articles
     *
     * @return HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
