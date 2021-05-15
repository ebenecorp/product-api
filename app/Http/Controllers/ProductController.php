<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     * path="/api/products",
     * summary="Get all products in the system",
     * description="Get all products in the system",
     * operationId="Products",
     * tags={"Products"},
     * 
     * 
     *  @OA\Response(
    *     response=200,
    *     description="Success",
    *     @OA\JsonContent(
    *        @OA\Property(property="product", type="object", ref="#/components/schemas/Product"),
    *     )
    *  ),
    * )
    */
    public function index()
    {
        //
        return Product::all();
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     /**
     * @OA\Post(
     * path="/api/products/",
     * summary="Save a new product into the system",
     * description="Save a new product into the system",
     * operationId="Products",
     * tags={"Products"},
     * security={ {"bearer": {} }},
     * 
     * @OA\RequestBody(
     *    required=true,
     *   
     *    description="Enter Product details",
     *    @OA\JsonContent(
     *       required={"name","slug", "price"},
     *       @OA\Property(property="name", type="string", example="IPhone 12"),
     *       @OA\Property(property="slug", type="string", example="IPhone-12"),
     *       @OA\Property(property="description", type="text", example="IPhone 12 phone description"),
     *       @OA\Property(property="price", type="decimal", example="4000.00"),
     *    ),
     * ),
     * @OA\Response(
     *    response=401,
     *    description="Invalid  Product detials entered",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Invalid  Product Details entered ")
     *        )
     *     ),
     * 
     *  @OA\Response(
    *     response=200,
    *     description="Success",
    *     @OA\JsonContent(
    *        @OA\Property(property="product", type="object", ref="#/components/schemas/Product"),
    *     )
    *  ),
    * )
    */

    public function store(ProductRequest $request)
    {
        //
       return $products = Product::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     * path="/api/products/id",
     * summary="Get a specific product in the system",
     * description="Get a specific product in the system",
     * operationId="Products",
     * tags={"Products"},
     * 
     * @OA\Response(
     *    response=401,
     *    description="Invalid  Product ID entered",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Invalid  Product ID entered ")
     *        )
     *     ),
     * 
     *  @OA\Response(
    *     response=200,
    *     description="Success",
    *     @OA\JsonContent(
    *        @OA\Property(property="user", type="object", ref="#/components/schemas/Product"),
    *     )
    *  ),
    * )
    */



    public function show($id)
    {
        return Product::findOrFail($id);
        //
    }

  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     /**
     * @OA\Post(
     * path="/api/products/ID",
     * summary="Update an existing product into the system",
     * description="Update an existing product into the system",
     * operationId="Products",
     * tags={"Products"},
     * security={ {"bearer": {} }},
     * 
     * @OA\RequestBody(
     *    required=true,
     *   
     *    description="Enter Product details",
     *    @OA\JsonContent(
     *       required={"name","slug", "price"},
     *       @OA\Property(property="name", type="string", example="IPhone 12"),
     *       @OA\Property(property="slug", type="string", example="IPhone-12"),
     *       @OA\Property(property="description", type="text", example="IPhone 12 phone description"),
     *       @OA\Property(property="price", type="decimal", example="4000.00"),
     *    ),
     * ),
     * @OA\Response(
     *    response=401,
     *    description="Invalid  Product detials entered",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Invalid  Product Details entered ")
     *        )
     *     ),
     * 
     *  @OA\Response(
    *     response=200,
    *     description="Success",
    *     @OA\JsonContent(
    *        @OA\Property(property="product", type="object", ref="#/components/schemas/Product"),
    *     )
    *  ),
    * )
    */

    public function update(ProductRequest $request, $id)
    {
        //
        $product = Product::findOrFail($id);
        
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     * path="/api/products/id",
     * summary="Delete a specific product in the system",
     * description="Delete a specific product in the system",
     * operationId="Products",
     * tags={"Products"},
     * security={ {"bearer": {} }},
     * 
     * @OA\Response(
     *    response=401,
     *    description="Invalid  Product ID entered",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Invalid  Product ID entered ")
     *        )
     *     ),
     * 
     *  @OA\Response(
    *     response=200,
    *     description="Success",
    *     @OA\JsonContent(
    *        @OA\Property(property="status", type="object", example="1"),
    *     )
    *  ),
    * )
    */

    public function destroy($id)
    {
        //
        return Product::destroy($id);
    }


    /**
     * search  storage for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     * path="/api/products/",
     * summary="seaech for product that matches search query in the system",
     * description="Delete a specific product in the system",
     * operationId="Products",
     * tags={"Products"},
     * 
     * @OA\Response(
     *    response=401,
     *    description="Invalid  search parameter entered",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Invalid  search parameter entered")
     *        )
     *     ),
     * 
     *  @OA\Response(
    *     response=200,
    *     description="Success",
    *     @OA\JsonContent(
    *        @OA\Property(property="user", type="object", ref="#/components/schemas/Product"),
    *     )
    *  ),
    * )
    */
    public function search($search)
    {
        //
        return Product::where('name', 'LIKE', "%{$search}%" )->get();
    }
}
