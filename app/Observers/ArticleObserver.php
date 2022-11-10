<?php

namespace App\Observers;

use App\Models\Article;
use App\Models\Category;

class ArticleObserver
{
    /**
     * Handle the Article "created" event.
     * antes de crear un article, crear las categorias no existentes
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function creating(Article $article)
    {
        $article->categories()->sync($article->categories->map(function ($category) {
            return $category->id ?? Category::firstOrCreate(['name' => $category->name])->id;
        }));
    }

    /**
     * Handle the Article "updated" event.
     * antes de actualizar un article, crear las categorias no existentes
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function updating(Article $article)
    {
        $article->categories()->sync($article->categories->map(function ($category) {
            return $category->id ?? Category::firstOrCreate(['name' => $category->name])->id;
        }));
    }

}
