<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use illuminate\Support\Facades\Auth;
class CartController extends Controller
{
    public function add_to_cart(Request $request, Product $product){
        $request->validate([
            "amount"=> "required|numeric|min:1|max:" . $product->stock,
        ]);
        $user_id = auth()->user()->id;
        $product_id = $product->id;

        $cart = Cart::create([
            "amount"=> $request->amount,
            "product_id"=> $product_id,
            "user_id"=> $user_id
        ]);
        return redirect()->route("show_product")->with("success","");
    }
}
