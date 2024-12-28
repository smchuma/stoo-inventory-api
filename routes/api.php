<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//authentication

Route::post("/register", [AuthController::class,"register"]);
Route::post("/login", [AuthController::class,"login"]);
Route::post("/logout", [AuthController::class,"logout"]);



Route::group(['middleware'=> 'auth:sanctum'], function () {

    //user
    Route::get('/all_users', [UserController::class, 'index']);
    Route::get('/user', [UserController::class, 'show']);
    Route::post('/add_user', [UserController::class, 'store']);

    //resource
    Route::apiResource("/category",CategoryController::class);
    Route::apiResource('/product', ProductController::class);
    Route::apiResource('/supplier', SupplierController::class);
});
