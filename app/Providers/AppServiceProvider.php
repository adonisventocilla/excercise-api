<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Article;
use App\Models\Category;
use App\Observers\ArticleObserver;
use App\Observers\CategoryObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Article::observe(ArticleObserver::class);
        Category::observe(CategoryObserver::class);
    }
}
