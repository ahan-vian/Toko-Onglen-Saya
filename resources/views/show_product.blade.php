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
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>