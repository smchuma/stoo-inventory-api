<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::all();

        if ($categories->count() == 0) {

            return response()->json([

                "message"=> "No Categories found"
            ]);
        } else {

        return $categories;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            "category_name"=> "required|string|max:255",
        ]);

        $category = Category::create($fields);

        return [
            "message"=> "Category created successfully",
            "category"=> $category
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        Try {
            $category = Category::findOrFail($id);
            return $category;

        } catch (ModelNotFoundException $e) {
            return response()->json([
                "message"=> "No Category Found"
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //

            $fields = $request->validate([
                "category_name" => "required|string|max:255"
            ]);

            $category->update($fields);

            return response()->json([
                "message"=> "Category name updated successfully",
                "category"=> $category

            ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();
        return response()->json([
            "message"=> "Category deleted successfully"
        ]);
    }
}
