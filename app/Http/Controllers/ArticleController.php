<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Category;

class ArticleController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //crear y guardar el articulo
        $article = new Article();
        $article->name = $request->name;
        $article->description = $request->description;
        $article->save();

        //creado el articulo, pasar las categorias separados por coma y actualizar.
        $article->categories = $request->category;
        $article->save();
        //return with session message
        return redirect()->route('home.index')->with('success', 'Article created successfully by ID: ' . $article->id);
    }


}
