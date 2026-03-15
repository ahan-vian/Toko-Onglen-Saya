<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Pesanan Saya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if($orders->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500 mb-4">Anda belum memiliki riwayat pesanan.</p>
                            <a href="{{ route('show_product') }}" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition-colors">
                                Mulai Belanja
                            </a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border-b py-3 px-4 font-semibold text-sm">ID Pesanan</th>
                                        <th class="border-b py-3 px-4 font-semibold text-sm">Tanggal</th>
                                        <th class="border-b py-3 px-4 font-semibold text-sm">Total Tagihan</th>
                                        <th class="border-b py-3 px-4 font-semibold text-sm">Status</th>
                                        <th class="border-b py-3 px-4 font-semibold text-sm text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        @php
                                            $totalHarga = 0;
                                            foreach ($order->transactions as $transaction) {
                                                if($transaction->product) {
                                                    $totalHarga += $transaction->product->price * $transaction->amount;
                                                }
                                            }
                                        @endphp
                                        
                                        <tr class="hover:bg-gray-50">
                                            <td class="border-b py-4 px-4 font-medium text-blue-600">
                                                #{{ $order->id }}
                                            </td>
                                            <td class="border-b py-4 px-4 text-gray-600">
                                                {{ $order->created_at->format('d M Y, H:i') }}
                                            </td>
                                            <td class="border-b py-4 px-4 font-bold text-gray-800">
                                                Rp {{ number_format($totalHarga, 0, ',', '.') }}
                                            </td>
                                            <td class="border-b py-4 px-4">
                                                @if ($order->is_paid)
                                                    <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">Lunas</span>
                                                @elseif ($order->payment_receipt)
                                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">Menunggu Konfirmasi</span>
                                                @else
                                                    <span class="bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full">Belum Dibayar</span>
                                                @endif
                                            </td>
                                            <td class="border-b py-4 px-4 text-center">
                                                <a href="{{ route('show_order', $order->id) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white text-sm font-bold py-2 px-4 rounded shadow transition-colors">
                                                    Lihat Detail
                                                </a>
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