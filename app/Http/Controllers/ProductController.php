<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $product = new Product();
        $product->user()->associate(Auth::user());
        $product->category()->associate(Category::where('name','=',$request->category_name)->first());
        $product->name=$request->name;
        $product->quantity=$request->quantity;
        $product->remain=$product->quantity;
        $product->about=$request->about;
        $product->price=$request->price;
        $product->save();
    }
    public function destroy(Request $request)
    {
        $product = Product::find($request->id);
        $product->delete();
    }

}

