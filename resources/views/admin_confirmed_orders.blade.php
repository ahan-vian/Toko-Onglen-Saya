<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✅ Pesanan Telah Dibayar
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">ID Pesanan</th>
                                <th class="px-6 py-3">Pelanggan</th>
                                <th class="px-6 py-3">Total Bayar</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4 font-medium text-gray-900">#{{ $order->id }}</td>
                                    <td class="px-6 py-4">
                                        <p class="font-bold">{{ $order->user->name }}</p>
                                        <p class="text-xs">{{ $order->user->phone }}</p>
                                    </td>
                                    <td class="px-6 py-4">Rp {{ number_format($order->transactions->sum(fn($t) => $t->amount * $t->product->price), 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Lunas</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('show_order', $order) }}" class="text-blue-600 hover:underline">Detail & Resi</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">Belum ada pesanan yang diselesaikan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>