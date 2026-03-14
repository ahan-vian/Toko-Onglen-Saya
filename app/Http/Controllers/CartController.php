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

        Cart::create([
            "amount"=> $request->amount,
            "product_id"=> $product_id,
            "user_id"=> $user_id
        ]);
        return redirect()->route("show_product")->with("success","");
    }

    public function show_cart()
    {
        $user_id = Auth::id(); 
        $carts = Cart::where('user_id', $user_id)->with('product')->get();
        return view('show_cart', compact('carts'));
    }

    public function update_cart(Request $request, Product $product){
        $request->validate([
            "amount"=> "required|numeric|min:1|max:" . $product->stock,
        ]);
        $user_id = auth()->user()->id;
        $product_id = $product->id;
        Cart::update([
            "amount"=> $request->amount,
            "product_id"=> $product_id,
            "user_id"=> $user_id
        ]);
        return redirect()->route("show_cart")->with("success","");
    }

    public function edit_cart(Cart $cart){
        return view("edit_cart", compact("cart"));
    }
    
    public function destroy_cart(Cart $cart){
        $cart->delete();
        return redirect()->route("show_cart")->with("success","");
    }
}
