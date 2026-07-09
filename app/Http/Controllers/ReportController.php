<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function products(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        $products = $query->latest()->paginate(15)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('reports.products', compact('products', 'categories'));
    }

    public function borrowings(Request $request)
    {
        $query = Borrowing::with(['details.product', 'creator']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('borrow_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('borrow_date', '<=', $request->date_to);
        }

        $borrowings = $query->latest()->paginate(15)->withQueryString();

        return view('reports.borrowings', compact('borrowings'));
    }

    public function exportProductsPdf(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        $products = $query->latest()->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.pdf.products', compact('products'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('laporan-barang-' . date('Y-m-d') . '.pdf');
    }

    public function exportProductsExcel(Request $request)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\ProductsExport($request->category, $request->condition),
            'laporan-barang-' . date('Y-m-d') . '.xlsx'
        );
    }

    public function exportBorrowingsPdf(Request $request)
    {
        $query = Borrowing::with(['details.product', 'creator']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('borrow_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('borrow_date', '<=', $request->date_to);
        }

        $borrowings = $query->latest()->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.pdf.borrowings', compact('borrowings'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('laporan-peminjaman-' . date('Y-m-d') . '.pdf');
    }

    public function exportBorrowingsExcel(Request $request)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\BorrowingsExport($request->status, $request->date_from, $request->date_to),
            'laporan-peminjaman-' . date('Y-m-d') . '.xlsx'
        );
    }
}
