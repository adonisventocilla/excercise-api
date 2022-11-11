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
        if (!$article->status) {
            $article->status = null;
        }
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
        //crear array de categorias
        $categories = explode(',', $article->categories);

        //eliminar atributo categories
        unset($article->categories);

        //recorrer array de categorias
        foreach ($categories as $category) {
            $category = Category::firstOrCreate(['name' => $category]);
            $article->categories()->attach($category->id);
        }
    }
}
