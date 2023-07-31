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
 
    Route::post('/products', [ProductCategoryController::class, 'createProduct']);//done
    Route::put('/products/{id}', [ProductCategoryController::class, 'updateProduct']);//done
    Route::delete('/products/{id}', [ProductCategoryController::class, 'deleteProduct']);//done
    Route::get('/products/{id}', [ProductCategoryController::class, 'getProduct']);//doone
    Route::get('/products', [ProductCategoryController::class, 'getAllProducts']);//done

    Route::post('/products/{product}/add-to-cart', [ProductCategoryController::class, 'addToCart']);
    // ->name('products.addToCart');

    
    Route::post('/categories', [ProductCategoryController::class, 'createCategory']);//done
    Route::put('/categories/{id}', [ProductCategoryController::class, 'updateCategory']);//done
    Route::delete('/categories/{id}', [ProductCategoryController::class, 'deleteCategory']);//done
    Route::get('/categories/{id}', [ProductCategoryController::class, 'getCategory']);//done
    Route::get('/categories', [ProductCategoryController::class, 'getAllCategories']);//done

    
    Route::get('/categories', [ProductCategoryController::class, 'index']);
    Route::get('/products', [ProductCategoryController::class, 'index2']);


});
