<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Produk: {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex flex-col md:flex-row gap-8">

                    <div class="w-full md:w-1/2">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full rounded-lg shadow-md object-cover">
                    </div>

                    <div class="w-full md:w-1/2 flex flex-col justify-start">
                        <h1 class="text-3xl font-bold mb-4 text-gray-900">{{ $product->name }}</h1>

                        <p class="text-3xl text-blue-600 font-bold mb-6">Rp
                            {{ number_format($product->price, 0, ',', '.') }}</p>

                        <div class="mb-6">
                            <span
                                class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-bold border border-green-300">
                                Sisa Stok: {{ $product->stock }}
                            </span>
                        </div>

                        <h3 class="text-lg font-bold mb-2 text-gray-800">Deskripsi:</h3>
                        <p class="text-gray-600 leading-relaxed mb-8">{!! nl2br(e($product->description)) !!}</p>

                        <div class="mt-auto">
                            <a href="{{ route('show_product') }}"
                                class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-6 rounded transition-colors">
                                &larr; Kembali ke Katalog
                            </a>
                            <a href="{{ route('edit_product', $product->id) }}"
                                class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded transition-colors ml-4">
                                &#9998; Edit Produk
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>