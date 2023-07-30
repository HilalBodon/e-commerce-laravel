<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductCategoryController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api' ,'prefix'=>'auth'],function($router) {
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::get('/profile',[AuthController::class,'profile']);
    Route::post('/logout',[AuthController::class,'logout']);
 
    // Route::get('/login', [AuthController::class, 'login'])->name('login');





    Route::post('/products', [ProductCategoryController::class, 'createProduct']);
    Route::put('/products/{id}', [ProductCategoryController::class, 'updateProduct']);
    Route::delete('/products/{id}', [ProductCategoryController::class, 'deleteProduct']);
    Route::get('/products/{id}', [ProductCategoryController::class, 'getProduct']);
    Route::get('/products', [ProductCategoryController::class, 'getAllProducts']);
    
    Route::post('/categories', [ProductCategoryController::class, 'createCategory']);
    Route::put('/categories/{id}', [ProductCategoryController::class, 'updateCategory']);
    Route::delete('/categories/{id}', [ProductCategoryController::class, 'deleteCategory']);
    Route::get('/categories/{id}', [ProductCategoryController::class, 'getCategory']);
    Route::get('/categories', [ProductCategoryController::class, 'getAllCategories']);



});
