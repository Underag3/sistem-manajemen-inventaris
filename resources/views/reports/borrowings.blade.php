<x-app-layout>
    @section('title', 'Laporan Peminjaman')
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Laporan Peminjaman</h2></x-slot>
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <form method="GET" class="flex flex-wrap gap-2 items-end">
                <div><label class="block text-xs text-gray-500 mb-1">Dari</label><input type="date" name="date_from" value="{{ request('date_from') }}" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm"></div>
                <div><label class="block text-xs text-gray-500 mb-1">Sampai</label><input type="date" name="date_to" value="{{ request('date_to') }}" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm"></div>
                <select name="status" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm"><option value="">Semua Status</option><option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Dipinjam</option><option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Dikembalikan</option></select>
                <button type="submit" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 text-sm">Filter</button>
                <div class="ml-auto flex gap-2">
                    <a href="{{ route('reports.borrowings.export.pdf', request()->query()) }}" class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded-lg transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>PDF</a>
                    <a href="{{ route('reports.borrowings.export.excel', request()->query()) }}" class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded-lg transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>Excel</a>
                </div>
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-700"><tr><th class="px-4 py-3">No.</th><th class="px-4 py-3">Peminjam</th><th class="px-4 py-3">Barang</th><th class="px-4 py-3">Tgl Pinjam</th><th class="px-4 py-3">Tgl Kembali</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Oleh</th></tr></thead>
                <tbody>
                    @forelse($borrowings as $i => $b)
                    <tr class="border-b dark:border-gray-700"><td class="px-4 py-3">{{ $borrowings->firstItem() + $i }}</td><td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $b->borrower_name }}</td><td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $b->details->map(fn($d) => $d->product->name . ' (x'.$d->quantity.')')->implode(', ') }}</td><td class="px-4 py-3">{{ $b->borrow_date->format('d/m/Y') }}</td><td class="px-4 py-3">{{ $b->return_date?->format('d/m/Y') ?? '-' }}</td><td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $b->status === 'borrowed' ? 'Dipinjam' : 'Dikembalikan' }}</td><td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $b->creator->name ?? '-' }}</td></tr>
                    @empty
                    <tr><td colspan="7" class="px-6 py-8 text-center text-gray-500">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $borrowings->links() }}</div>
    </div>
</x-app-layout>
