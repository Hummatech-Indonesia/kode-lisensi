<?php

namespace App\Models;

use App\Base\Interfaces\HasArticles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArticleCategory extends Model implements HasArticles
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
}
