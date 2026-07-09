<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BorrowingResource;
use App\Models\Borrowing;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Borrowing::with(['details.product', 'creator']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $borrowings = $query->latest()->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'message' => 'Borrowings retrieved successfully.',
            'data' => BorrowingResource::collection($borrowings),
            'meta' => [
                'current_page' => $borrowings->currentPage(),
                'last_page' => $borrowings->lastPage(),
                'per_page' => $borrowings->perPage(),
                'total' => $borrowings->total(),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'borrower_name' => 'required|string|max:255',
            'borrow_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            $borrowing = DB::transaction(function () use ($validated, $request) {
                foreach ($validated['items'] as $item) {
                    $product = Product::lockForUpdate()->findOrFail($item['product_id']);
                    if ($product->stock < $item['quantity']) {
                        throw new \Exception("Insufficient stock for {$product->name}. Available: {$product->stock}, Requested: {$item['quantity']}");
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
                    Product::findOrFail($item['product_id'])->decrement('stock', $item['quantity']);
                }

                return $borrowing->load(['details.product', 'creator']);
            });

            return response()->json([
                'success' => true,
                'message' => 'Borrowing created successfully.',
                'data' => new BorrowingResource($borrowing),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 422);
        }
    }

    public function show(Borrowing $borrowing)
    {
        $borrowing->load(['details.product', 'creator']);

        return response()->json([
            'success' => true,
            'message' => 'Borrowing retrieved successfully.',
            'data' => new BorrowingResource($borrowing),
        ]);
    }

    public function returnItems(Borrowing $borrowing)
    {
        if ($borrowing->isReturned()) {
            return response()->json([
                'success' => false,
                'message' => 'This borrowing has already been returned.',
                'data' => null,
            ], 422);
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

            return response()->json([
                'success' => true,
                'message' => 'Items returned successfully.',
                'data' => new BorrowingResource($borrowing->fresh()->load(['details.product', 'creator'])),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to return items: ' . $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }
}
