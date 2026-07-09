<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalBorrowings = Borrowing::count();
        $borrowedItems = Product::whereHas('borrowingDetails', function ($q) {
            $q->where('status', 'borrowed');
        })->count();
        $availableProducts = $totalProducts - $borrowedItems;
        $lowStockProducts = Product::lowStock()->with('category')->get();
        $damagedProducts = Product::damaged()->count();

        // Chart data: borrowings per month (last 12 months)
        $chartData = Borrowing::select(
            DB::raw("DATE_FORMAT(borrow_date, '%Y-%m') as month"),
            DB::raw('COUNT(*) as total')
        )
            ->where('borrow_date', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $chartLabels = $chartData->pluck('month')->toArray();
        $chartValues = $chartData->pluck('total')->toArray();

        // Additional Chart Data: Category Distribution (Top 5)
        $categoriesChart = Category::withCount('products')->orderByDesc('products_count')->take(5)->get();
        $categoriesLabels = $categoriesChart->pluck('name')->toArray();
        $categoriesValues = $categoriesChart->pluck('products_count')->toArray();

        // Additional Chart Data: Product Condition Distribution
        $conditionsChart = Product::select('condition', DB::raw('count(*) as total'))
            ->groupBy('condition')
            ->get();
        $conditionsLabels = $conditionsChart->pluck('condition')->toArray();
        $conditionsValues = $conditionsChart->pluck('total')->toArray();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalBorrowings',
            'borrowedItems',
            'availableProducts',
            'lowStockProducts',
            'damagedProducts',
            'chartLabels',
            'chartValues',
            'categoriesLabels',
            'categoriesValues',
            'conditionsLabels',
            'conditionsValues'
        ));
    }
}
