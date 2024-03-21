<?php

namespace App\Models;

use App\Base\Interfaces\HasArticleCategory;
use App\Base\Interfaces\HasUser;
use App\Traits\ScopeSearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model implements HasArticleCategory, HasUser
{
    use HasFactory, ScopeSearchTrait;

    public $fillable = ['id', 'article_category_id', 'title', 'description', 'photo', 'content', 'tags', 'slug', 'status', 'user_id', 'view'];
    protected $table = 'articles';
    protected $primaryKey = 'id';

    /**
     * One-to-Many relationship with Article Category Model
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
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
