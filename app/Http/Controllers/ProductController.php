<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $category = Category::find($request->category_id);

        if (!$category)  return response()->json([
            'status'=> false,
            'message' => 'category doesnt exist'
        ]); 

        $this->validate($request,[
            'category_id'=> 'required',
            'name'=> 'required',
            'brand'=>'required',
            'price'=>'required',
            'availability'=>'required',
            'description'=>'required',
        ]);

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->brand=$request->brand;
        $product->price=$request->price;
        $product->availability=$request->availability;
        $product->description=$request->description;
        $product->save();

        return response()->json([
            'status'=> true,
            'data' => $product
        ]);       
    }
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->price=$request->price;
        $product->availability=0;
        $product->description=$request->description;
        $product->save();

        return response()->json([
            'status'=> true,
            'success' => 'created successfully',
            'data' => $product
        ]);
    }
    public function allProducts()
    {
        return response()->json([
            'status'=> true,
            'product' => Product::all()
        ]);
    }
    public function getProduct()
    {
        return response()->json([
            'status'=> true,
            'data' => Product::all()
            ]);
    }

    public function getSingleProduct($id)
    {
        $product = Product::find($id);      
        return response()->json([
            'status'=> true,
            'product' => $product
        ]);
    }
}
