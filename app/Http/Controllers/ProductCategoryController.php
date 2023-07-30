<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;


class ProductCategoryController extends Controller
{

    public function createProduct(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'price' => 'required|numeric',
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
            $categoryId = $request->input('category_id');
            $category = Category::find($categoryId);
    
            $product = new Product();
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
    
            $product->category()->associate($category);
            $product->save();
            return response()->json(['message' => 'Product created successfully']);
        }


    public function updateProduct(Request $request, $id)
    {
        $rules = [
            'name' => 'required|max:255',
            'price' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->save();

        return response()->json(['message' => 'Product updated successfully', 'product' => $product], 200);
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    public function getProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json(['product' => $product], 200);
    }

    public function getAllProducts()
    {
        $products = Product::all();

        return response()->json(['products' => $products], 200);
    }



    public function updateCategory(Request $request, $id)
    {
        $rules = [
            'name' => 'required|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $category = Category::find($id);
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $category->name = $request->input('name');
        $category->save();

        return response()->json(['message' => 'Category updated successfully', 'category' => $category], 200);
    }

    // ____________________________________________________

    public function createCategory(Request $request)
{
    $rules = [
        'name' => 'required|max:255',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    $category = new Category();
    $category->name = $request->input('name');
    $category->save();

    return response()->json(['message' => 'Category created successfully', 'category' => $category], 201);
}
}