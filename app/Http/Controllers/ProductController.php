<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    
    public function create_product(){
        return view('create_product');
    }

    public function store_product(Request $request){
        $request->validate([
            'name'=> 'required',
            'price'=> 'required|numeric',
            'description'=> 'required',
            'image'=>'required',
            'stock'=> 'required|numeric',
        ]);
        $file = $request->file('image');
        $path = time() .'_'. $request->name . '_' . $file->getClientOriginalExtension();
        Storage::disk('local')->put('public/'. $path, file_get_contents($file));

        Product::create([
            'name'=> $request->name,
            'price'=> $request->price,
            'description'=> $request->description,
            'image'=> $path,
            'stock'=> $request->stock,
        ]);
        return redirect()->route('create_product')->with('success','berhasil menambahkan product');
    }

    public function show_product(){
        $product = Product::all();
        return view('show_product', compact('product'));
    }
}
