<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json([
            'status'=> true,
        ]);
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required'
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return response()->json([
            'status'=> true,
            'category' => $category
        ]);

    }
    public function update(Request $request, $id)
    {
        $category = Product::find($id);
        $category->name = $request->name;
        $category->save();

        return response()->json([
            'status'=> true,
            'success' => 'created successfully',
            'data' => $category
        ]);
    }
    public function allCategories()
    {
        return response()->json([
            'status'=> true,
            'category' => Category::all()
            ]);
    }
        public function categorywithproduct()
    {
        return response()->json([
            'status'=> true,
            'data' => Category::with('product')->get()
            ]);
    }


    public function getSingleCategory($id)
    {
        $category = Category::find($id);
        return response()->json([
            'status'=> true,
            'category' => $category
        ]);
    }

    public function getSingleCategoryProducts($id)
    {
        $category = Category::find($id);
        $category_products = $category->product->where('category_id', $id);
        return response()->json([
            'status'=> true,
            'category_products' => $category_products
        ]);
    }
}       