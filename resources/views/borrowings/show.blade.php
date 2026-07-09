<x-app-layout>
    @section('title', 'Detail Peminjaman')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Detail Peminjaman #{{ $borrowing->id }}</h2>
            <a href="{{ route('borrowings.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-800">&larr; Kembali</a>
        </div>
    </x-slot>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-4">Informasi Peminjaman</h3>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Peminjam</dt><dd class="mt-1 text-gray-900 dark:text-white font-medium">{{ $borrowing->borrower_name }}</dd></div>
                <div><dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Dibuat Oleh</dt><dd class="mt-1 text-gray-900 dark:text-white">{{ $borrowing->creator->name ?? '-' }}</dd></div>
                <div><dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Pinjam</dt><dd class="mt-1 text-gray-900 dark:text-white">{{ $borrowing->borrow_date->format('d M Y') }}</dd></div>
                <div><dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Kembali</dt><dd class="mt-1 text-gray-900 dark:text-white">{{ $borrowing->return_date?->format('d M Y') ?? '-' }}</dd></div>
                <div><dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt><dd class="mt-1 text-gray-900 dark:text-white font-medium">{{ $borrowing->status === 'borrowed' ? 'Dipinjam' : 'Dikembalikan' }}</dd></div>
            </dl>
            @if($borrowing->status === 'borrowed')
            <div class="mt-6"><form action="{{ route('borrowings.return', $borrowing) }}" method="POST" x-data @submit.prevent="if(confirm('Konfirmasi pengembalian semua barang?')) $el.submit()">@csrf @method('PATCH')<button type="submit" class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg transition-colors">Kembalikan Semua Barang</button></form></div>
            @endif
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-4">Barang Dipinjam</h3>
            <div class="space-y-3">
                @foreach($borrowing->details as $detail)
                <div class="p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                    <p class="font-medium text-gray-900 dark:text-white">{{ $detail->product->name }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $detail->product->code }} | {{ $detail->product->category->name ?? '-' }}</p>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-sm text-gray-700 dark:text-gray-300">Qty: {{ $detail->quantity }}</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">{{ $detail->status === 'borrowed' ? 'Dipinjam' : 'Dikembalikan' }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
