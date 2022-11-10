<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

/**
 * @OA\Info(
 *  title="Exercise API",
 *  version="1.0",
 *  description="Exercise API for Delfosti"
 * ),
 * @OA\Server(url="http://exercise-api.test/"),
 */

class ArticleController extends Controller
{
    /**
     * @OA\Get(
     *  path="/api/v1/article?search={search}",
     *  tags={"Articles"},
     *  summary="Search article by name",
     *  description="Search articles by name and return details with categories.",
     *  @OA\Parameter(
     *      description="Parameter to search by name",
     *      in="path",
     *      name="search",
     *      required=true,
     *      @OA\Schema(type="string"),
     *      example="Jaida",
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="View article's details",
     *      @OA\JsonContent(
     *          @OA\Property(property="id", type="number", example=10),
     *          @OA\Property(property="name", type="string", example="Camioneta Chevrolet"),
     *          @OA\Property(property="description", type="string", example="Camioneta Chevrolet 2010"),
     *          @OA\Property(property="status", type="number", example=1),
     *          @OA\Property(property="created_at", type="string", example="2022-10-10 10:10:10.000000Z"),
     *          @OA\Property(property="updated_at", type="string", example="2022-10-10 10:10:10.000000Z"),
     *          @OA\Property(property="categories", type="array", @OA\Articles(
     *              @OA\Property(property="id", type="number", example=10),
     *              @OA\Property(property="name", type="string", example="Vehiculo"),
     *              @OA\Property(property="slug", type="string", example="vehiculo"),
     *          ), ),
     *      )
     *  ),
     *  @OA\Response(
     *      response="default",
     *      description="An unexpected error occurred.",
     *  )
     * )
     */
    
    public function search(Request $request)
    {
        $search = $request->input('search');
        $article = ArticleResource::collection(
            Article::where('name', 'like',"%".$search."%")
            ->with('categories')->has("categories")
            ->orderby('id', 'desc')
            ->get()
        );
        return response()->json($article);
    }

    /**
     * @OA\Get(
     *  path="/api/v1/articles?qty={qty}",
     *  tags={"Articles"},
     *  summary="List all articles",
     *  description="List all articles by quantity",
     *  @OA\Parameter(
     *      description="Parameter to set the quantity of articles to return",
     *      in="path",
     *      name="qty",
     *      required=false,
     *      @OA\Schema(type="integer"),
     *      example=10,
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="View article's details",
     *      @OA\JsonContent(
     *          @OA\Property(property="id", type="number", example=10),
     *          @OA\Property(property="name", type="string", example="Camioneta Chevrolet"),
     *          @OA\Property(property="description", type="string", example="Camioneta Chevrolet 2010"),
     *          @OA\Property(property="status", type="number", example=1),
     *          @OA\Property(property="created_at", type="string", example="2022-10-10 10:10:10.000000Z"),
     *          @OA\Property(property="updated_at", type="string", example="2022-10-10 10:10:10.000000Z"),
     *      )
     *  ),
     *  @OA\Response(
     *      response="default",
     *      description="An unexpected error occurred.",
     *  )
     * )
     */
    
    public function articles(Request $request)
    {
        $search = $request->input('qty');
        $article = ArticleResource::collection(
            Article::all()
            ->take($search)
        );
        return response()->json($article);
    }

    /**
     * @OA\Get(
     *  path="/api/v1/category?search={search}",
     *  tags={"Category"},
     *  summary="Search category by name",
     *  description="Search categories by name and return details with categories.",
     *  @OA\Parameter(
     *      description="Parameter to search by name",
     *      in="path",
     *      name="search",
     *      required=true,
     *      @OA\Schema(type="string"),
     *      example="Petro",
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="View category's details",
     *      @OA\JsonContent(
     *          @OA\Property(property="id", type="number", example=10),
     *          @OA\Property(property="name", type="string", example="Camioneta Chevrolet"),
     *          @OA\Property(property="slug", type="string", example="camioneta-chevrolet-2010"),
     *      )
     *  ),
     *  @OA\Response(
     *      response="default",
     *      description="An unexpected error occurred.",
     *  )
     * )
     */
    
    public function searchCategory(Request $request)
    {
        $search = $request->input('search');
        $article = CategoryResource::collection(
            Category::where('name', 'like',"%".$search."%")
            ->get()
        );
        return response()->json($article);
    }
}
