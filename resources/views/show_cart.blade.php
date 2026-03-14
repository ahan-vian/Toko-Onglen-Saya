<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Keranjang Belanja
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('success'))
                        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($carts->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500 mb-4">Keranjang belanja Anda masih kosong.</p>
                            <a href="{{ route('show_product') }}" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
                                Mulai Belanja
                            </a>
                        </div>
                    @else
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border-b py-3 px-4 font-semibold text-sm">Produk</th>
                                    <th class="border-b py-3 px-4 font-semibold text-sm">Harga Satuan</th>
                                    <th class="border-b py-3 px-4 font-semibold text-sm text-center">Jumlah</th>
                                    <th class="border-b py-3 px-4 font-semibold text-sm text-right">Subtotal</th>
                                    <th class="border-b py-3 px-4 font-semibold text-sm text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalHarga = 0; 
                                @endphp 
                                @foreach ($carts as $cart)
    
                                @if ($cart->product) 
                                    
                                    @php 
                                        $subtotal = $cart->product->price * $cart->amount; 
                                        $totalHarga += $subtotal; 
                                    @endphp

                                    <tr class="hover:bg-gray-50">
                                        <td class="border-b py-4 px-4 flex items-center gap-4">
                                            <img src="{{ asset('storage/' . $cart->product->image) }}" alt="Gambar" class="w-16 h-16 object-cover rounded-md shadow-sm">
                                            <span class="font-medium">{{ $cart->product->name }}</span>
                                        </td>
                                        
                                        <td class="border-b py-4 px-4 text-gray-600">
                                            Rp {{ number_format($cart->product->price, 0, ',', '.') }}
                                        </td>
                                        
                                        <td class="border-b py-4 px-4 text-center">
                                            <span class="bg-gray-200 px-3 py-1 rounded-full font-bold text-gray-700">
                                                {{ $cart->amount }}
                                            </span>
                                        </td>
                                        
                                        <td class="border-b py-4 px-4 text-right font-bold text-blue-600">
                                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                                        </td>

                                        <td class="border-b py-4 px-4 text-center">
                                            <form action="{{ route('destroy_cart', $cart->id) }}" method="POST" 
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini dari keranjang?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>

                                @endif 
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-8 flex flex-col items-end border-t pt-6">
                            <div class="flex items-center gap-4 mb-4">
                                <span class="text-lg text-gray-600">Total Tagihan:</span>
                                <span class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                            </div>
                            
                            <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition-colors text-lg">
                                Lanjutkan ke Pembayaran (Checkout)
                            </button>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>