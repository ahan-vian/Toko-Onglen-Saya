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
use Illuminate\Support\Facades\Storage;

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
    public function index_order()
    {
        $user_id = Auth::id();
        $orders = Order::with('transactions.product')
                        ->where('user_id', $user_id)
                        ->latest()
                        ->get();
        return view('index_order', compact('orders'));
    }
    public function submit_payment(Request $request, Order $order){
        if($order->user_id != Auth::user()->id){
            return redirect()->back()->with('error','Anda tidak memilki akses!');
        }
        $request->validate([
            'payment_recept'=> 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if($request->hasFile('payment_recept')){
            $file = $request->file('payment_recept');
            $path = $file->store('receipts', 'public');
            $order->update([
                'payment_recept'=>$path,
            ]);
            return redirect()->back()->with('success','Bukti Pembayaran Berhasil di unggah');
        }
        return redirect()->back()->with('error','Gagal menggunggah bukti pembayaran');
    }

    public function confirm_payment(Request $request, Order $order){
        $order->update([
            'is_paid'=>True
        ]);
        
        return redirect()->back()->with('success','Pembayaran berhasil di Konfirmasi!');
    }
    public function index_admin()
    {
        // Mengambil pesanan yang SUDAH upload struk tapi BELUM lunas
        $orders = Order::with(['user', 'transactions.product'])
                        ->whereNotNull('payment_recept')
                        ->where('is_paid', false)
                        ->latest()
                        ->get();

        return view('index_admin_payment', compact('orders'));
    }
}
