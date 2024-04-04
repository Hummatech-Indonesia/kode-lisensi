<?php

namespace App\Helpers;

use App\Enums\ArticleStatusEnum;
use App\Models\Article;

class ArticleHelper
{
    /**
     * Get top articles to render in homepage
     *
     * @param int $take
     * @return object
     */

    public static function topArticles(int $take = 6): object
    {
        return Article::query()
            ->where('status', ArticleStatusEnum::PUBLISHED->value)
            ->with(['sub_article_category', 'user'])
            ->take($take)
            ->latest()
            ->get();
    }
}
