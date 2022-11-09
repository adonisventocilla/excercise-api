<?php

namespace App\Observers;

use App\Models\Item;
use App\Models\Category;

class ItemObserver
{
    /**
     * Handle the Item "created" event.
     * antes de crear un item, crear las categorias no existentes
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function creating(Item $item)
    {
        $item->categories()->sync($item->categories->map(function ($category) {
            return $category->id ?? Category::firstOrCreate(['name' => $category->name])->id;
        }));
    }

    /**
     * Handle the Item "updated" event.
     * antes de actualizar un item, crear las categorias no existentes
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function updating(Item $item)
    {
        $item->categories()->sync($item->categories->map(function ($category) {
            return $category->id ?? Category::firstOrCreate(['name' => $category->name])->id;
        }));
    }

}
