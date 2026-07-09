<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBorrowingRequest;
use App\Models\Borrowing;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        $query = Borrowing::with(['details.product', 'creator']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('borrower_name', 'like', "%{$search}%")
                  ->orWhereHas('details.product', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $borrowings = $query->latest()->paginate(10)->withQueryString();

        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $products = Product::where('stock', '>', 0)
            ->where('condition', 'Baik')
            ->orderBy('name')
            ->get();

        return view('borrowings.create', compact('products'));
    }

    public function store(StoreBorrowingRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::transaction(function () use ($validated, $request) {
                foreach ($validated['items'] as $item) {
                    $product = Product::lockForUpdate()->findOrFail($item['product_id']);
                    if ($product->stock < $item['quantity']) {
                        throw new \Exception("Stok {$product->name} tidak mencukupi. Tersedia: {$product->stock}, Diminta: {$item['quantity']}");
                    }
                }

                $borrowing = Borrowing::create([
                    'borrower_name' => $validated['borrower_name'],
                    'borrow_date' => $validated['borrow_date'],
                    'status' => 'borrowed',
                    'created_by' => $request->user()->id,
                ]);

                foreach ($validated['items'] as $item) {
                    $borrowing->details()->create([
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'status' => 'borrowed',
                    ]);

                    $product = Product::findOrFail($item['product_id']);
                    $product->decrement('stock', $item['quantity']);
                }
            });

            return redirect()->route('borrowings.index')
                ->with('success', 'Peminjaman berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function show(Borrowing $borrowing)
    {
        $borrowing->load(['details.product.category', 'creator']);
        return view('borrowings.show', compact('borrowing'));
    }

    public function returnItems(Borrowing $borrowing)
    {
        if ($borrowing->isReturned()) {
            return redirect()->route('borrowings.index')
                ->with('error', 'Peminjaman sudah dikembalikan sebelumnya.');
        }

        try {
            DB::transaction(function () use ($borrowing) {
                foreach ($borrowing->details as $detail) {
                    if ($detail->status === 'borrowed') {
                        $detail->update(['status' => 'returned']);
                        $detail->product->increment('stock', $detail->quantity);
                    }
                }

                $borrowing->update([
                    'status' => 'returned',
                    'return_date' => now(),
                ]);
            });

            return redirect()->route('borrowings.index')
                ->with('success', 'Barang berhasil dikembalikan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengembalikan barang: ' . $e->getMessage());
        }
    }
}
