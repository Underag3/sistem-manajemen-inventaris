<?php

namespace Database\Seeders;

use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Schema;

class BorrowingSeeder extends Seeder
{
    public function run(): void
    {
        // Delete existing borrowings to avoid duplicate constraints or weird counts
        Schema::disableForeignKeyConstraints();
        BorrowingDetail::truncate();
        Borrowing::truncate();
        Schema::enableForeignKeyConstraints();

        $staff = User::whereHas('role', function ($q) {
            $q->where('name', 'Staff');
        })->first() ?? User::first();

        $products = Product::all();

        if ($products->isEmpty()) {
            return;
        }

        $borrowers = [
            'Budi Santoso', 'Siti Rahma', 'Andi Wijaya', 'Dewi Lestari', 
            'Eko Prasetyo', 'Rina Melati', 'Hendra Kusuma', 'Mega Utami',
            'Rian Hidayat', 'Lisa Permata', 'Aditya Nugraha', 'Yuni Kartika'
        ];

        // Seed borrowings over the last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $monthDate = Carbon::now()->subMonths($i);
            
            // Generate a random number of borrowings for this month (e.g., 4 to 12)
            $borrowingsCount = rand(4, 12);

            for ($j = 0; $j < $borrowingsCount; $j++) {
                // Random day within the month
                $day = rand(1, 28);
                $borrowDate = Carbon::create($monthDate->year, $monthDate->month, $day);

                // Ensure we don't generate future dates
                if ($borrowDate->isAfter(Carbon::now())) {
                    continue;
                }

                // Status distribution: 80% returned, 20% still borrowed
                $isReturned = rand(1, 10) <= 8;
                $status = $isReturned ? 'returned' : 'borrowed';
                
                $returnDate = null;
                if ($isReturned) {
                    // Return date is 1 to 10 days after borrow date
                    $returnDate = (clone $borrowDate)->addDays(rand(1, 10));
                    // Don't let return date be in the future
                    if ($returnDate->isAfter(Carbon::now())) {
                        $returnDate = Carbon::now();
                    }
                }

                $borrowing = Borrowing::create([
                    'borrower_name' => $borrowers[array_rand($borrowers)],
                    'borrow_date' => $borrowDate,
                    'return_date' => $returnDate,
                    'status' => $status,
                    'created_by' => $staff->id,
                ]);

                // Add 1 to 3 items to this borrowing
                $itemsCount = rand(1, 3);
                $randomProducts = $products->random(min($itemsCount, $products->count()));

                foreach ($randomProducts as $product) {
                    BorrowingDetail::create([
                        'borrowing_id' => $borrowing->id,
                        'product_id' => $product->id,
                        'quantity' => rand(1, 2),
                        'status' => $status,
                    ]);
                }
            }
        }
    }
}
