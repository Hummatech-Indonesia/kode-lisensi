<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubArticleCategory extends Model
{


    protected $fillable = ['name', 'article_category_id'];
    use HasFactory;

    /**
     * Get the articleCategory that owns the SubArticleCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function articleCategory(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class);
    }
}
