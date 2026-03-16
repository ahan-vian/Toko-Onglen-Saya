<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Pesanan #{{ $order->id }}
        </h2>
    </x-slot>
    <div class="mt-6 mb-6 bg-white p-6 rounded-lg shadow-sm border border-gray-200">
    <h4 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">📦 Informasi Pengiriman</h4>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
        
        <div>
            <p class="text-gray-500 font-semibold">Nama Penerima:</p>
            <p class="text-gray-800 font-medium">{{ $order->user?->name ?? 'User Tidak Ditemukan / Dihapus' }}</p>
        </div>
        
        <div>
            <p class="text-gray-500 font-semibold">Nomor Handphone:</p>
            @if($order->user?->phone)
                <p class="text-gray-800 font-medium">{{ $order->user->phone }}</p>
            @else
                <p class="text-red-600 italic">Belum diisi. <a href="{{ route('profile.edit') }}" class="underline hover:text-red-800">Lengkapi di Profil</a></p>
            @endif
        </div>
        
        <div class="md:col-span-2">
            <p class="text-gray-500 font-semibold">Alamat Lengkap:</p>
            @if($order->user?->address)
                <p class="text-gray-800 font-medium">{{ $order->user->address }}</p>
            @else
                <p class="text-red-600 italic">Belum diisi. <a href="{{ route('profile.edit') }}" class="underline hover:text-red-800">Lengkapi di Profil</a></p>
            @endif
        </div>
        
    </div>
</div>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('success'))
                        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 border-b pb-4">
                        <div>
                            <h3 class="text-lg font-bold">Informasi Pesanan</h3>
                            <p class="text-sm text-gray-500">Tanggal: {{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            @if ($order->is_paid)
                                <span class="bg-green-100 text-green-800 text-sm font-medium px-4 py-2 rounded-full border border-green-300">
                                    ✅ Lunas (Terkonfirmasi)
                                </span>
                            @elseif ($order->payment_recept)
                                <span class="bg-yellow-100 text-yellow-800 text-sm font-medium px-4 py-2 rounded-full border border-yellow-300">
                                    ⏳ Menunggu Konfirmasi Admin
                                </span>
                            @else
                                <span class="bg-red-100 text-red-800 text-sm font-medium px-4 py-2 rounded-full border border-red-300">
                                    ❌ Belum Dibayar
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="overflow-x-auto mb-6">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border-b py-3 px-4 font-semibold text-sm">Produk</th>
                                    <th class="border-b py-3 px-4 font-semibold text-sm text-center">Harga Satuan</th>
                                    <th class="border-b py-3 px-4 font-semibold text-sm text-center">Jumlah</th>
                                    <th class="border-b py-3 px-4 font-semibold text-sm text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $grandTotal = 0; @endphp
                                @foreach ($order->transactions as $transaction)
                                    @php 
                                        $subtotal = $transaction->product->price * $transaction->amount; 
                                        $grandTotal += $subtotal;
                                    @endphp
                                    <tr class="hover:bg-gray-50">
                                        <td class="border-b py-3 px-4 flex items-center gap-4">
                                            <img src="{{ asset('storage/' . $transaction->product->image) }}" alt="Gambar" class="w-12 h-12 object-cover rounded shadow-sm">
                                            <span class="font-medium">{{ $transaction->product->name }}</span>
                                        </td>
                                        <td class="border-b py-3 px-4 text-center text-gray-600">
                                            Rp {{ number_format($transaction->product->price, 0, ',', '.') }}
                                        </td>
                                        <td class="border-b py-3 px-4 text-center">
                                            {{ $transaction->amount }}
                                        </td>
                                        <td class="border-b py-3 px-4 text-right font-medium">
                                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-end mb-8">
                        <div class="bg-gray-50 p-4 rounded-lg border w-full md:w-1/2 lg:w-1/3 flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-700">Total Tagihan:</span>
                            <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    @if (!$order->is_paid && !$order->payment_recept)
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                            <h4 class="text-lg font-bold text-blue-900 mb-2">Instruksi Pembayaran</h4>
                            <p class="text-sm text-blue-800 mb-4">Silakan transfer sebesar <strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong> ke rekening berikut, lalu upload bukti transfer Anda di bawah ini.</p>
                            
                            <ul class="list-disc list-inside text-sm text-blue-800 mb-6 font-medium">
                                <li>BCA: 1234567890 a.n Toko Keren</li>
                                <li>Mandiri: 0987654321 a.n Toko Keren</li>
                            </ul>
                            <form action="{{ route('submit_payment', $order->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-4 items-center">
                                @csrf
                                <input type="file" name="payment_recept" required accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                                <button type="submit" class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-md shadow transition-colors text-sm">
                                    Upload Bukti
                                </button>
                            </form>
                        </div>
                    @endif

                    @if ($order->payment_recept)
                        <div class="mt-6 border-t pt-6">
                            <h4 class="text-md font-bold text-gray-700 mb-4">Bukti Pembayaran Anda:</h4>
                            <img src="{{ asset('storage/' . $order->payment_recept) }}" alt="Bukti Transfer" class="max-w-xs rounded-lg shadow-md border">
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>