<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{

    public function create_product()
    {
        return view('create_product');
    }

    public function store_product(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required',
            'stock' => 'required|numeric',
        ]);
        $file = $request->file('image');
        $path = time() . '_' . $request->name . '_' . $file->getClientOriginalExtension();
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
            'stock' => $request->stock,
        ]);
        return redirect()->route('create_product')->with('success', 'berhasil menambahkan product');
    }

    public function show_product()
    {
        $product = Product::all();
        return view('show_product', compact('product'));
    }

    public function detail_product(product $product)
    {
        return view('detail_product', compact('product'));
    }

    public function edit_product(product $product)
    {
        return view('edit_product', compact('product'));
    }
    public function update_product(Request $request, product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'nullable',
            'stock' => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('public/' . $path, file_get_contents($file));
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $path,
                'stock' => $request->stock,
            ]);
        } else {
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                //'image'=> $path,
                'stock' => $request->stock,
            ]);
        }
        return redirect()->route('show_product')->with('success', 'berhasil update');
    }

    public function destroy_product(product $product){
        $product->delete();
        return redirect()->route('show_product')->with('success','Berhasil Hapus product!');
    }
}
