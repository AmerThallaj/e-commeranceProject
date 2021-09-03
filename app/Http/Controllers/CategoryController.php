<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        if(Category::where('name','=',$request->name)->first())
        {
            return ['category already exist'];
        }
        else{
            $category = new Category();
            $category->name = $request->name;
            $category->save();
        }

    }
    public function destroy(Request $request)
    {
        $category = Category::where('name','=',$request->name)->first();
        $category->delete();
    }
    public function categories()
    {
        return [Category::all()->orderBy('name')];
    }
}
