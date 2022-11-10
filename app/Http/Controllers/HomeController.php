<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        //store article from form
        $article = new Article();
        $article->name = $request->name;
        $article->description = $request->description;
        $article->status = null;
        $article->categories(
            //insertar el name de la categoria según $request->category separado por coma


        );
        dd($request->category, $article->categories());
        $article->save();

        back()->withSuccess('Article added success!');
    }
}
