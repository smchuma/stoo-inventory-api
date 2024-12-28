<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $supplier = Supplier::all();

         if($supplier->count() == 0){
            return [
                "message"=> "No Supplier Found"
            ];
         }


         return $supplier;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $fields = $request->validate([
            "first_name"=> "required|string|max:255",
            "last_name"=> "required|string|max:255",
            "email"=> "required|unique:suppliers,email",
           'phone_number' => [
                'required',
                'regex:/^0[67]\d{8}$/',
                'unique:suppliers,phone_number'
                ],
        ]);

        $supplier = Supplier::create($fields);

        return response()->json([
            "message"=> "Supplier added successfully",
            "supplier"=> $supplier
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
