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
    public function checkout(Request $request)
    {
        $request->validate([
            'cart_ids' => 'required|array',
        ], [
            'cart_ids.required' => 'Silakan pilih minimal satu barang untuk di-checkout.'
        ]);
        $user_id = Auth::id();
        $carts = Cart::whereIn('id', $request->cart_ids)
            ->where('user_id', $user_id)
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->withErrors('Barang yang dipilih tidak valid.');
        }
        DB::beginTransaction();
        try {

            $order = Order::create([
                'user_id' => $user_id,
                'is_paid' => false,
            ]);

            foreach ($carts as $cart) {
                $product = Product::find($cart->product_id);

                if ($product->stock < $cart->amount) {
                    DB::rollBack();
                    return redirect()->back()->withErrors('Stok produk ' . $product->name . ' tidak mencukupi.');
                }

                Transaction::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'amount' => $cart->amount,
                ]);

                $product->update([
                    'stock' => $product->stock - $cart->amount
                ]);
                $cart->delete();
            }

            DB::commit();

            return redirect()->route('show_order', $order->id)->with('success', 'Checkout berhasil!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function show_order(Order $order){
        if($order->user_id != Auth::user()->id){
            return redirect()->route('show_product', $order->id)->with('error','Anda tidak memiliki akses ke pesanan ini.');
        }
        $order->load('transactions.product');
        return view('show_order', compact('order'));
    }
}
