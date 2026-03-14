<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Katalog Produk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @foreach($product as $item)
                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">

                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                            class="w-full h-48 object-cover">

                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-800">{{ $item->name }}</h3>

                            <!-- <p class="text-gray-600 text-sm mt-1">{{ Str::limit($item->description, 50) }}</p> -->

                            <div class="mt-4 flex justify-between items-center">
                                <span class="font-bold text-blue-600">Rp
                                    {{ number_format($item->price, 0, ',', '.') }}</span>
                                <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full">Stok:
                                    {{ $item->stock }}</span>
                            </div>
                            <a href="{{ route('detail_product', $item->id) }}"
                                class="mt-4 block text-center w-full bg-gray-800 text-white py-2 rounded hover:bg-gray-700 transition-colors">
                                Lihat Detail
                            </a>
                            <form action="{{ route('add_to_cart', $item->id) }}" method="POST" class="mt-4">
                                @csrf

                                <div class="flex items-center gap-3">
                                    <div class="w-24">
                                        <label for="amount" class="sr-only">Jumlah</label>
                                        <input type="number" name="amount" id="amount" value="1" min="1"
                                            max="{{ $item->stock }}"
                                            class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm text-center"
                                            required>
                                    </div>

                                    <button type="submit"
                                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors shadow-sm flex justify-center items-center gap-2">
                                        <svg xmlns="http://www.apache.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Masukkan Keranjang
                                    </button>
                                </div>

                                <p class="text-xs text-gray-500 mt-2">Maksimal pembelian: {{ $item->stock }} item</p>
                            </form>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>