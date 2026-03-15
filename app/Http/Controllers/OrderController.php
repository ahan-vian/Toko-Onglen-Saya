<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use function PHPUnit\Framework\returnArgument;

class OrderController extends Controller
{
    public function checkout()
    {
        $user_id = Auth::id();
        $carts = Cart::where("user_id", $user_id)->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->with("error", "Keranjang anda masih kosong!");
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                "user_id" => $user_id,
                "is_paid" => false,
            ]);

            foreach ($carts as $cart) {
                $product = Product::find($cart->product_id);

                if ($product->stock < $cart->amount) {
                    DB::rollBack();
                    return redirect()->back()->with("error", "Maaf Stock product" . $product->name . "Tidak mencukupi. Sisa stok" . $product->stock);
                }
                Transaction::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'amount' => $cart->amount
                ]);
                $product->update([
                    'stock' => $product->stock - $cart->amount
                ]);
            }
            Cart::where('user_id', $user_id)->delete();
            DB::commit();
            return redirect()->route('show_order')->with('success', 'Checkout berhasil! Silakan upload bukti pembayaran.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
