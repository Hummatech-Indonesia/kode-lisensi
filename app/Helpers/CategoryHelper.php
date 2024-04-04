<?php

namespace App\Helpers;

use App\Models\ArticleCategory;
use App\Models\Category;

class CategoryHelper
{
    /**
     * Get 10 top categories to render in homepage
     *
     * @param int $take
     * @return object
     */

    public static function topCategory(int $take = 15): object
    {
        return Category::query()
            ->withCount('products')
            ->take($take)
            ->orderByDesc('products_count')
            ->get();
    }

    /**
     * articleCategory
     *
     * @return object
     */
    public static function articleCategory(): object
    {
        return ArticleCategory::query()
            ->with('sub_article_categories')
            ->get();
    }
}
