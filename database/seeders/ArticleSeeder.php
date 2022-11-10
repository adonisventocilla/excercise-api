<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::factory()->count(10)->create()->each(function ($article) {
            $article->categories()->attach(
                Category::inRandomOrder()->limit(rand(1, 3))->get()
            );
        });
    }
}
