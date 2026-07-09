<x-app-layout>
    @section('title', 'Tambah Peminjaman')
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Tambah Peminjaman</h2></x-slot>
    <div class="max-w-4xl">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <form method="POST" action="{{ route('borrowings.store') }}" x-data="borrowingForm()">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div><label for="borrower_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Peminjam <span class="text-red-500">*</span></label><input type="text" name="borrower_name" id="borrower_name" value="{{ old('borrower_name') }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-red-500 focus:border-red-500" required>@error('borrower_name')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror</div>
                    <div><label for="borrow_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Pinjam <span class="text-red-500">*</span></label><input type="date" name="borrow_date" id="borrow_date" value="{{ old('borrow_date', date('Y-m-d')) }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-red-500 focus:border-red-500" required>@error('borrow_date')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror</div>
                </div>
                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Barang yang Dipinjam <span class="text-red-500">*</span></h3>
                @error('items')<p class="mb-2 text-sm text-red-500">{{ $message }}</p>@enderror
                <template x-for="(item, index) in items" :key="index">
                    <div class="flex flex-wrap gap-2 mb-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                        <div class="flex-1 min-w-[200px]"><select :name="`items[${index}][product_id]`" x-model="item.product_id" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-red-500 focus:border-red-500 text-sm" required><option value="">Pilih Barang</option>@foreach($products as $product)<option value="{{ $product->id }}">{{ $product->code }} - {{ $product->name }} (Stok: {{ $product->stock }})</option>@endforeach</select></div>
                        <div class="w-24"><input type="number" :name="`items[${index}][quantity]`" x-model="item.quantity" min="1" placeholder="Qty" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-red-500 focus:border-red-500 text-sm" required></div>
                        <button type="button" @click="removeItem(index)" x-show="items.length > 1" class="p-2 text-red-500 hover:text-red-700"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                    </div>
                </template>
                <button type="button" @click="addItem()" class="mb-6 inline-flex items-center px-3 py-2 text-sm text-red-600 dark:text-red-400 hover:text-red-800 border border-red-300 dark:border-red-700 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>Tambah Barang</button>
                <div class="flex items-center gap-3">
                    <button type="submit" class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors">Simpan Peminjaman</button>
                    <a href="{{ route('borrowings.index') }}" class="px-6 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">Batal</a>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
    <script>
        function borrowingForm() {
            return {
                items: [{ product_id: '', quantity: 1 }],
                addItem() { this.items.push({ product_id: '', quantity: 1 }); },
                removeItem(index) { this.items.splice(index, 1); }
            }
        }
    </script>
    @endpush
</x-app-layout>
