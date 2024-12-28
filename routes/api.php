<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post("/register", [AuthController::class,"register"]);
Route::post("/login", [AuthController::class,"login"]);
Route::post("/logout", [AuthController::class,"logout"]);


Route::apiResource("/category",CategoryController::class);
Route::apiResource('/product', ProductController::class);
Route::apiResource('/supplier', SupplierController::class);
