<x-app-layout>
    @section('title', 'Detail Barang')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Detail Barang</h2>
            <a href="{{ route('products.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-800">&larr; Kembali</a>
        </div>
    </x-slot>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            @php $condColors = ['Baik' => 'bg-green-100 text-green-700', 'Rusak Ringan' => 'bg-yellow-100 text-yellow-700', 'Rusak Berat' => 'bg-red-100 text-red-700', 'Dalam Perbaikan' => 'bg-blue-100 text-blue-700']; @endphp
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Kode Barang</dt><dd class="mt-1 font-mono text-gray-900 dark:text-white">{{ $product->code }}</dd></div>
                <div><dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Barang</dt><dd class="mt-1 text-gray-900 dark:text-white">{{ $product->name }}</dd></div>
                <div><dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Kategori</dt><dd class="mt-1 text-gray-900 dark:text-white">{{ $product->category->name ?? '-' }}</dd></div>
                <div><dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Kondisi</dt><dd class="mt-1 text-gray-900 dark:text-white">{{ $product->condition }}</dd></div>
                <div><dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Stok</dt><dd class="mt-1 text-2xl font-bold {{ $product->isLowStock() ? 'text-red-600' : 'text-gray-900 dark:text-white' }}">{{ $product->stock }} <span class="text-sm font-normal text-gray-500">(min: {{ $product->minimum_stock }})</span></dd></div>
                <div><dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Lokasi Penyimpanan</dt><dd class="mt-1 text-gray-900 dark:text-white">{{ $product->storage_location }}</dd></div>
                <div><dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Dibuat</dt><dd class="mt-1 text-gray-900 dark:text-white">{{ $product->created_at->format('d M Y, H:i') }}</dd></div>
                <div><dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Terakhir Diubah</dt><dd class="mt-1 text-gray-900 dark:text-white">{{ $product->updated_at->format('d M Y, H:i') }}</dd></div>
            </dl>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-3">Gambar Barang</h3>
            @if($product->image)<img src="{{ Storage::url($product->image) }}" class="w-full rounded-lg object-cover" alt="{{ $product->name }}">@else<div class="w-full h-48 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center"><span class="text-gray-400">Tidak ada gambar</span></div>@endif
        </div>
    </div>
    @if($product->borrowingDetails->count() > 0)
    <div class="mt-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700"><h3 class="font-semibold text-gray-800 dark:text-gray-200">Riwayat Peminjaman</h3></div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm"><thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-700"><tr><th class="px-4 py-3">Peminjam</th><th class="px-4 py-3">Qty</th><th class="px-4 py-3">Tgl Pinjam</th><th class="px-4 py-3">Status</th></tr></thead>
                <tbody>@foreach($product->borrowingDetails->take(10) as $detail)<tr class="border-b dark:border-gray-700"><td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $detail->borrowing->borrower_name }}</td><td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $detail->quantity }}</td><td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $detail->borrowing->borrow_date->format('d/m/Y') }}</td><td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $detail->status === 'borrowed' ? 'Dipinjam' : 'Dikembalikan' }}</td></tr>@endforeach</tbody>
            </table>
        </div>
    </div>
    @endif
</x-app-layout>
