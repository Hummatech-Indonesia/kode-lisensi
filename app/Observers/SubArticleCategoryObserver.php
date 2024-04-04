<?php

namespace App\Observers;

use App\Models\SubArticleCategory;

class SubArticleCategoryObserver
{
    /**
     * Handle the SubArticleCategory "created" event.
     *
     * @param  \App\Models\SubArticleCategory  $subArticleCategory
     * @return void
     */
    public function creating(SubArticleCategory $subArticleCategory)
    {
        $subArticleCategory->slug = str_slug($subArticleCategory->name);
    }

    /**
     * Handle the SubArticleCategory "updated" event.
     *
     * @param  \App\Models\SubArticleCategory  $subArticleCategory
     * @return void
     */
    public function updating(SubArticleCategory $subArticleCategory)
    {
        $subArticleCategory->slug = str_slug($subArticleCategory->name);
    }
}
