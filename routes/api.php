<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//public routes
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {
Route::post('/logout',[AuthController::class,'logout']);
Route::post('/newPassword',[AuthController::class,'changePassword']);
Route::post('/newCategory',[CategoryController::class,'store']);
Route::post('/newProduct',[ProductController::class,'store']);
Route::post('/buyProduct',[DealController::class,'sell']);
Route::post('/myDeals',[DealController::class,'myDeals']);
});


