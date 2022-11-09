<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    
    public function store(Request $request)
    {
        //store item from form
        $item = new Item();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->status = null;
        $item->categories(
            collect(explode(',', $request->category))->map(function ($category) {
                return ['name' => $category];
            })
        );
        dd($request->category, $item->categories());
        $item->save();

        back()->withSuccess('Item added success!');
    }
}
