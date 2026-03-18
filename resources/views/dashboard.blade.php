<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Profil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border-l-4 border-blue-600">
                <div class="p-6 text-gray-900 flex items-center gap-4">
                    <div class="bg-blue-100 p-4 rounded-full text-2xl">
                        👋
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Selamat datang kembali, {{ Auth::user()->name }}!</h3>
                        <p class="text-gray-600 mt-1">Senang melihat Anda lagi. Apa yang ingin Anda lakukan hari ini?</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <a href="{{ route('show_product') }}" class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 flex flex-col items-center text-center group transform hover:-translate-y-1">
                    <div class="bg-indigo-50 text-4xl p-4 rounded-full mb-4 group-hover:bg-indigo-100 transition-colors">
                        🛍️
                    </div>
                    <h4 class="font-bold text-lg text-gray-800 mb-1">Mulai Belanja</h4>
                    <p class="text-sm text-gray-500">Lihat katalog produk terbaru kami</p>
                </a>

                <a href="{{ route('index_order') }}" class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 flex flex-col items-center text-center group transform hover:-translate-y-1">
                    <div class="bg-green-50 text-4xl p-4 rounded-full mb-4 group-hover:bg-green-100 transition-colors">
                        📦
                    </div>
                    <h4 class="font-bold text-lg text-gray-800 mb-1">Cek Pesanan</h4>
                    <p class="text-sm text-gray-500">Pantau status pembayaran & resi Anda</p>
                </a>

                <a href="{{ route('show_cart') }}" class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 flex flex-col items-center text-center group transform hover:-translate-y-1">
                    <div class="bg-yellow-50 text-4xl p-4 rounded-full mb-4 group-hover:bg-yellow-100 transition-colors">
                        🛒
                    </div>
                    <h4 class="font-bold text-lg text-gray-800 mb-1">Keranjang Saya</h4>
                    <p class="text-sm text-gray-500">Lanjutkan proses *checkout* pesanan</p>
                </a>

            </div>

        </div>
    </div>
</x-app-layout>