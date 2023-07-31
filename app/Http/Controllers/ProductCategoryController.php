<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;



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

// __________________________________________________

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

// ___________________________________________

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
    // _____________________________________________

    public function getProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json(['product' => $product], 200);
    }
    // _____________________________________________________

    public function getAllProducts()
    {
        $products = Product::all();

        return response()->json(['products' => $products], 200);
    }
    // __________________________________________________


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

// _________________________________________________

public function deleteCategory($id)
{
    $category = Category::find($id);
    if (!$category) {
        return response()->json(['error' => 'Category not found'], 404);
    }

    $category->delete();

    return response()->json(['message' => 'Category deleted successfully'], 200);
}
// ____________________________________________________


public function getCategory($id)
{
    $category = Category::find($id);
    if (!$category) {
        return response()->json(['error' => 'Category not found'], 404);
    }

    return response()->json(['Category' => $category], 200);
}
// _____________________________________________________

public function getAllCategories()
{
    $category = Category::all();

    return response()->json(['category' => $category], 200);
}

// ___________________________________________________________
// --------------------------------------------------------------


public function addToCart(Request $request, Product $product)
{
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $user = Auth::users();

    $cartItem = Cart::where('user_id', $user->id)
        ->where('product_id', $product->id)
        ->first();

    if ($cartItem) {
        $cartItem->quantity += $request->input('quantity');
        $cartItem->save();
    } else {
        $cartItem = new Cart([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => $request->input('quantity'),
            'price' => $product->price,
        ]);
        $cartItem->save();
    }
    return response()->json(['message' => 'product added to cart successfully', 'product' => $product], 201);

    // return redirect()->route('products.index')->with('success', 'Product added to cart successfully!');
}




public function index()
{
    $categories = Category::all();
    return response()->json($categories);
}

public function index2()
{
    $products = Product::all();
    return response()->json($products);
}
}