<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
//public routes
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

//protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
Route::post('/logout',[AuthController::class,'logout']);
Route::post('/newPassword',[AuthController::class,'changePassword']);
Route::post('/newCategory',[CategoryController::class,'store']);
Route::post('/newProduct',[ProductController::class,'store']);
Route::post('/buyProduct',[DealController::class,'sell']);
Route::post('/deleteProduct',[ProductController::class,'destroy']);
Route::post('/myDeals',[DealController::class,'myDeals']);
Route::post('/deleteDeal',[DealController::class,'destroy']);
});


