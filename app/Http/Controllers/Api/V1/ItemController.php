<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

/**
 * @OA\Info(
 *  title="Exercise API",
 *  version="1.0",
 *  description="Exercise API for Delfosti"
 * ),
 * @OA\Server(url="http://exercise-api.test/"),
 * @OA\Server(url="http://exercise-api.adonisventocilla.com/")
 */

class ItemController extends Controller
{
    /**
     * @OA\Get(
     *  path="/api/v1/item?search={search}",
     *  tags={"Items"},
     *  summary="Search item by name",
     *  description="Search items by name and return details with categories.",
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
     *      description="View item's details",
     *      @OA\JsonContent(
     *          @OA\Property(property="id", type="number", example=10),
     *          @OA\Property(property="name", type="string", example="Camioneta Chevrolet"),
     *          @OA\Property(property="description", type="string", example="Camioneta Chevrolet 2010"),
     *          @OA\Property(property="status", type="number", example=1),
     *          @OA\Property(property="created_at", type="string", example="2022-10-10 10:10:10.000000Z"),
     *          @OA\Property(property="updated_at", type="string", example="2022-10-10 10:10:10.000000Z"),
     *          @OA\Property(property="categories", type="array", @OA\Items(
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
        $item = ItemResource::collection(
            Item::where('name', 'like',"%".$search."%")
            ->with('categories')->has("categories")
            ->orderby('id', 'desc')
            ->get()
        );
        return response()->json($item);
    }

    /**
     * @OA\Get(
     *  path="/api/v1/items?qty={qty}",
     *  tags={"Items"},
     *  summary="List all items",
     *  description="List all items by quantity",
     *  @OA\Parameter(
     *      description="Parameter to set the quantity of items to return",
     *      in="path",
     *      name="qty",
     *      required=false,
     *      @OA\Schema(type="integer"),
     *      example=10,
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="View item's details",
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
    
    public function items(Request $request)
    {
        $search = $request->input('qty');
        $item = ItemResource::collection(
            Item::all()
            ->take($search)
        );
        return response()->json($item);
    }

    // /**
    //  * @OA\Get(
    //  *  path="/api/v1/category?search={search}",
    //  *  tags={"Category"},
    //  *  summary="Search category by name",
    //  *  description="Search categories by name and return details with categories.",
    //  *  @OA\Parameter(
    //  *      description="Parameter to search by name",
    //  *      in="path",
    //  *      name="search",
    //  *      required=true,
    //  *      @OA\Schema(type="string"),
    //  *      example="Jaida",
    //  *  ),
    //  *  @OA\Response(
    //  *      response=200,
    //  *      description="View category's details",
    //  *      @OA\JsonContent(
    //  *          @OA\Property(property="id", type="number", example=10),
    //  *          @OA\Property(property="name", type="string", example="Camioneta Chevrolet"),
    //  *          @OA\Property(property="description", type="string", example="Camioneta Chevrolet 2010"),
    //  *          @OA\Property(property="status", type="number", example=1),
    //  *          @OA\Property(property="created_at", type="string", example="2022-10-10 10:10:10.000000Z"),
    //  *          @OA\Property(property="updated_at", type="string", example="2022-10-10 10:10:10.000000Z"),
    //  *          @OA\Property(property="categories", type="array", @OA\Items(
    //  *              @OA\Property(property="id", type="number", example=10),
    //  *              @OA\Property(property="name", type="string", example="Vehiculo"),
    //  *              @OA\Property(property="slug", type="string", example="vehiculo"),
    //  *          ), ),
    //  *      )
    //  *  ),
    //  *  @OA\Response(
    //  *      response="default",
    //  *      description="An unexpected error occurred.",
    //  *  )
    //  * )
    //  */
    
    // public function searchCategory(Request $request)
    // {
    //     $search = $request->input('search');
    //     $item = CategoryResource::collection(
    //         Category::where('name', 'like',"%".$search."%")
    //         ->get()->toArray()
    //     );
    //     return response()->json($item);
    // }
}
