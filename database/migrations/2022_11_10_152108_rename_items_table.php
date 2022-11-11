<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //rename items table to articles
        Schema::rename('items', 'articles');

        //rename category_item table to article_category
        Schema::rename('category_item', 'article_category');
        Schema::table('article_category', function (Blueprint $table) {
            $table->renameColumn('item_id', 'article_id');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
        Schema::dropIfExists('article_category');
    }
}
