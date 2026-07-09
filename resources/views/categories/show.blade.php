<x-app-layout>
    @section('title', 'Detail Kategori')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Detail Kategori: {{ $category->name }}</h2>
            <a href="{{ route('categories.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200">&larr; Kembali</a>
        </div>
    </x-slot>
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-6">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Kategori</dt><dd class="mt-1 text-gray-900 dark:text-white">{{ $category->name }}</dd></div>
            <div><dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Jumlah Barang</dt><dd class="mt-1 text-gray-900 dark:text-white">{{ $category->products_count }}</dd></div>
            <div class="md:col-span-2"><dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Deskripsi</dt><dd class="mt-1 text-gray-900 dark:text-white">{{ $category->description ?? '-' }}</dd></div>
        </dl>
    </div>
    @if($products->count() > 0)
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700"><h3 class="font-semibold text-gray-800 dark:text-gray-200">Barang dalam Kategori</h3></div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-700"><tr><th class="px-6 py-3">Kode</th><th class="px-6 py-3">Nama</th><th class="px-6 py-3">Stok</th><th class="px-6 py-3">Kondisi</th></tr></thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="border-b dark:border-gray-700">
                        <td class="px-6 py-3 font-medium text-gray-900 dark:text-white">{{ $product->code }}</td>
                        <td class="px-6 py-3 text-gray-700 dark:text-gray-300">{{ $product->name }}</td>
                        <td class="px-6 py-3 text-gray-700 dark:text-gray-300">{{ $product->stock }}</td>
                        <td class="px-6 py-3 text-gray-700 dark:text-gray-300">{{ $product->condition }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $products->links() }}</div>
    </div>
    @endif
</x-app-layout>
