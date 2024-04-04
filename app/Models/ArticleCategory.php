<?php

namespace App\Models;

use App\Base\Interfaces\HasArticles;
use App\Base\Interfaces\HasSubArticleCategories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArticleCategory extends Model implements HasArticles, HasSubArticleCategories
{
    use HasFactory;

    public $fillable = ['id', 'name'];
    protected $table = 'article_categories';
    protected $primaryKey = 'id';

    /**
     * One-to-Many relationship with Article Model
     *
     * @return HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * sub_article_categories
     *
     * @return HasMany
     */
    public function sub_article_categories(): HasMany
    {
        return $this->hasMany(SubArticleCategory::class);
    }
}
