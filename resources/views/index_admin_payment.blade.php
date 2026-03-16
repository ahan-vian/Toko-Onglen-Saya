<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dasbor Admin: Pesanan Masuk
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

                    @if($orders->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500 mb-4 text-lg">Saat ini tidak ada pesanan yang butuh konfirmasi.
                            </p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-indigo-50">
                                        <th class="border-b py-3 px-4 font-semibold text-sm text-indigo-900">ID Order</th>
                                        <th class="border-b py-3 px-4 font-semibold text-sm text-indigo-900">Pelanggan</th>
                                        <th class="border-b py-3 px-4 font-semibold text-sm text-indigo-900">Total Tagihan
                                        </th>
                                        <th class="border-b py-3 px-4 font-semibold text-sm text-indigo-900 text-center">
                                            Bukti Transfer</th>
                                        <th class="border-b py-3 px-4 font-semibold text-sm text-indigo-900 text-center">
                                            Aksi Konfirmasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        @php
                                            // Hitung total tagihan pesanan ini
                                            $totalHarga = 0;
                                            foreach ($order->transactions as $transaction) {
                                                if ($transaction->product) {
                                                    $totalHarga += $transaction->product->price * $transaction->amount;
                                                }
                                            }
                                        @endphp

                                        <tr class="hover:bg-gray-50">
                                            <td class="border-b py-4 px-4 font-bold text-gray-800">
                                                #{{ $order->id }}
                                            </td>
                                            <td class="border-b py-4 px-4 text-gray-700">
                                                <span
                                                    class="font-semibold">{{ $order->user->name ?? 'User Dihapus' }}</span><br>
                                                <span
                                                    class="text-xs text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</span>

                                                <div class="mt-2 text-sm bg-indigo-50 p-2 rounded border border-indigo-100">
                                                    <p class="mb-1"><span class="font-bold text-indigo-900">📞 HP:</span>
                                                        {{ $order->user->phone ?? 'Belum diisi' }}</p>
                                                    <p><span class="font-bold text-indigo-900">🏠 Alamat:</span>
                                                        {{ $order->user->address ?? 'Belum diisi' }}</p>
                                                </div>
                                            </td>
                                            <td class="border-b py-4 px-4 font-bold text-blue-600">
                                                Rp {{ number_format($totalHarga, 0, ',', '.') }}
                                            </td>
                                            <td class="border-b py-4 px-4 text-center">
                                                <a href="{{ asset('storage/' . $order->payment_recept) }}" target="_blank"
                                                    class="inline-block group">
                                                    <img src="{{ asset('storage/' . $order->payment_recept) }}" alt="Struk"
                                                        class="w-16 h-16 object-cover rounded shadow border border-gray-300 group-hover:opacity-80 transition-opacity mx-auto">
                                                    <span class="text-xs text-blue-500 hover:underline mt-1 block">Lihat
                                                        Struk</span>
                                                </a>
                                            </td>
                                            <td class="border-b py-4 px-4 text-center">
                                                <form action="{{ route('confirm_payment', $order->id) }}" method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin dana sudah masuk ke rekening dan ingin mengkonfirmasi pesanan ini?');">
                                                    @csrf
                                                    <button type="submit"
                                                        class="bg-green-600 hover:bg-green-700 text-white text-sm font-bold py-2 px-4 rounded shadow transition-colors">
                                                        ✅ Konfirmasi Pembayaran
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>