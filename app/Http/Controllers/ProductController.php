<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::all();

        if($products->count() == 0) {

            return response()->json([
                "message"=> "No products Found"
            ]);
        } else {
        return $products;

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(  Request $request)
    {
        //
        $fields = $request->validate([
            "product_name"=> "required|string|max:255",
            "category_id"=> "required",
            "price"=> "required|integer",
            "supplier_id"=> "required",
            "quantity"=> "required",
        ]);

        $product = Product::create($fields);
        return response()->json([
            "message"=> "Product created successfully",
            "product"=> $product
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
