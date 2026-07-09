<x-app-layout>
    @section('title', 'Barang')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Data Barang</h2>
            @if(Auth::user()->hasRole('Admin', 'Staff'))
            <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>Tambah Barang
            </a>
            @endif
        </div>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <form method="GET" class="flex flex-wrap gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode/nama/lokasi..." class="flex-1 min-w-[200px] rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-red-500 focus:border-red-500 text-sm">
                <select name="category" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-red-500 focus:border-red-500 text-sm">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)<option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>@endforeach
                </select>
                <select name="condition" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-red-500 focus:border-red-500 text-sm">
                    <option value="">Semua Kondisi</option>
                    @foreach(['Baik', 'Rusak Ringan', 'Rusak Berat', 'Dalam Perbaikan'] as $cond)<option value="{{ $cond }}" {{ request('condition') == $cond ? 'selected' : '' }}>{{ $cond }}</option>@endforeach
                </select>
                <button type="submit" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 text-sm">Filter</button>
                @if(request()->hasAny(['search','category','condition']))<a href="{{ route('products.index') }}" class="px-4 py-2 text-sm text-gray-500">Reset</a>@endif
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-700">
                    <tr><th class="px-4 py-3">No.</th><th class="px-4 py-3">Kode</th><th class="px-4 py-3">Nama Barang</th><th class="px-4 py-3">Kategori</th><th class="px-4 py-3">Stok</th><th class="px-4 py-3">Lokasi</th><th class="px-4 py-3">Kondisi</th><th class="px-4 py-3">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($products as $i => $product)
                    <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $products->firstItem() + $i }}</td>
                        <td class="px-4 py-3 font-mono text-gray-900 dark:text-white">{{ $product->code }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $product->name }}</td>
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $product->category->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $product->stock }}</td>
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $product->storage_location }}</td>
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $product->condition }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('products.show', $product) }}" class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300" title="Detail"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></a>
                                @if(Auth::user()->hasRole('Admin', 'Staff'))
                                <a href="{{ route('products.edit', $product) }}" class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300" title="Edit"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" x-data @submit.prevent="if(confirm('Yakin ingin menghapus?')) $el.submit()">@csrf @method('DELETE')<button type="submit" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300" title="Hapus"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button></form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">Belum ada data barang.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $products->links() }}</div>
    </div>
</x-app-layout>
