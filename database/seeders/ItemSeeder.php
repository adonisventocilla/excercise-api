<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Category;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::factory()->count(10)->create()->each(function ($item) {
            $item->categories()->attach(
                Category::inRandomOrder()->limit(rand(1, 3))->get()
            );
        });
    }
}
