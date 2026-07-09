<x-app-layout>
    @section('title', 'Peminjaman')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Data Peminjaman</h2>
            <a href="{{ route('borrowings.create') }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>Tambah Peminjaman
            </a>
        </div>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <form method="GET" class="flex flex-wrap gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama peminjam/barang..." class="flex-1 min-w-[200px] rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-red-500 focus:border-red-500 text-sm">
                <select name="status" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-red-500 focus:border-red-500 text-sm"><option value="">Semua Status</option><option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Dipinjam</option><option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Dikembalikan</option></select>
                <button type="submit" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 text-sm">Filter</button>
                @if(request()->hasAny(['search','status']))<a href="{{ route('borrowings.index') }}" class="px-4 py-2 text-sm text-gray-500">Reset</a>@endif
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-700"><tr><th class="px-4 py-3">No.</th><th class="px-4 py-3">Peminjam</th><th class="px-4 py-3">Barang</th><th class="px-4 py-3">Tgl Pinjam</th><th class="px-4 py-3">Tgl Kembali</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Aksi</th></tr></thead>
                <tbody>
                    @forelse($borrowings as $i => $borrowing)
                    <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $borrowings->firstItem() + $i }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $borrowing->borrower_name }}</td>
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-300">@foreach($borrowing->details as $detail)<span class="inline-block px-2 py-0.5 mb-1 text-xs bg-gray-100 dark:bg-gray-700 rounded">{{ $detail->product->name }} (x{{ $detail->quantity }})</span> @endforeach</td>
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $borrowing->return_date?->format('d/m/Y') ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $borrowing->status === 'borrowed' ? 'Dipinjam' : 'Dikembalikan' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('borrowings.show', $borrowing) }}" class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300" title="Detail"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></a>
                                @if($borrowing->status === 'borrowed')
                                <form action="{{ route('borrowings.return', $borrowing) }}" method="POST" x-data @submit.prevent="if(confirm('Konfirmasi pengembalian barang?')) $el.submit()">@csrf @method('PATCH')<button type="submit" class="text-red-600 dark:text-red-500 hover:text-red-800 dark:hover:text-red-400 underline font-medium text-xs bg-transparent p-0 border-0">Kembalikan</button></form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">Belum ada data peminjaman.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $borrowings->links() }}</div>
    </div>
</x-app-layout>
