<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Produk Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('success'))
                        <div class="mb-6 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded-md">
                            <strong>Oops! Ada kesalahan input:</strong>
                            <ul class="list-disc list-inside mt-2 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('store_product') }}" method="post" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                placeholder="Contoh: Boneka Teddy Bear">
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi
                                Produk</label>
                            <textarea name="description" id="description" rows="4"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                placeholder="Jelaskan detail produk di sini...">{{ old('description') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                                <input type="number" name="price" id="price" value="{{ old('price') }}"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    placeholder="Contoh: 50000">
                            </div>

                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700">Stok Tersedia</label>
                                <input type="number" name="stock" id="stock" value="{{ old('stock') }}"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    placeholder="Contoh: 10">
                            </div>
                        </div>

                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500 
                                file:mr-4 file:py-2 file:px-4 
                                file:rounded-md file:border-0 
                                file:text-sm file:font-semibold 
                                file:bg-gray-100 file:text-gray-700 
                                hover:file:bg-gray-200 border border-gray-300 rounded-md p-2">
                        </div>

                        <div class="flex items-center justify-end mt-8 border-t pt-4">
                            <a href="{{ route('show_product') }}"
                                class="text-sm text-gray-600 hover:text-gray-900 underline mr-6">
                                Batal
                            </a>
                            <button type="submit"
                                class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-md transition-colors shadow-sm">
                                Simpan Produk
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>