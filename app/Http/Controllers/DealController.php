<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller
{
    public function sell(Request $request)
    {
        $product= Product::find($request->product_id);
        if($product->remain>0)
        {
            $product->remain--;
            $product->save();
            $deal=new Deal();
            $deal->user()->associate(Auth::user());
            $deal->product()->associate($product);
            $deal->save();
        }
        else return['not available'];
    }
    public function myDeals()
    {
      return Deal::where('buyer_id','=',\auth()->user()->getAuthIdentifier())->get();
    }
}
