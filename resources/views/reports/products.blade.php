<x-app-layout>
    @section('title', 'Laporan Barang')
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Laporan Data Barang</h2></x-slot>
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <form method="GET" class="flex flex-wrap gap-2 items-end">
                <select name="category" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-red-500 focus:border-red-500 text-sm"><option value="">Semua Kategori</option>@foreach($categories as $cat)<option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>@endforeach</select>
                <select name="condition" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-red-500 focus:border-red-500 text-sm"><option value="">Semua Kondisi</option>@foreach(['Baik', 'Rusak Ringan', 'Rusak Berat', 'Dalam Perbaikan'] as $cond)<option value="{{ $cond }}" {{ request('condition') == $cond ? 'selected' : '' }}>{{ $cond }}</option>@endforeach</select>
                <button type="submit" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 text-sm">Filter</button>
                <div class="ml-auto flex gap-2">
                    <a href="{{ route('reports.products.export.pdf', request()->query()) }}" class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded-lg transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>PDF</a>
                    <a href="{{ route('reports.products.export.excel', request()->query()) }}" class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded-lg transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>Excel</a>
                </div>
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-700"><tr><th class="px-4 py-3">No.</th><th class="px-4 py-3">Kode</th><th class="px-4 py-3">Nama</th><th class="px-4 py-3">Kategori</th><th class="px-4 py-3">Stok</th><th class="px-4 py-3">Min</th><th class="px-4 py-3">Lokasi</th><th class="px-4 py-3">Kondisi</th></tr></thead>
                <tbody>
                    @forelse($products as $i => $p)
                    <tr class="border-b dark:border-gray-700"><td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $products->firstItem() + $i }}</td><td class="px-4 py-3 font-mono text-gray-900 dark:text-white">{{ $p->code }}</td><td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $p->name }}</td><td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $p->category->name ?? '-' }}</td><td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $p->stock }}</td><td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $p->minimum_stock }}</td><td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $p->storage_location }}</td><td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $p->condition }}</td></tr>
                    @empty
                    <tr><td colspan="8" class="px-6 py-8 text-center text-gray-500">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $products->links() }}</div>
    </div>
</x-app-layout>
