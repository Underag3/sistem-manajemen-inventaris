<?php

namespace App\Exports;

use App\Models\Borrowing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BorrowingsExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(
        protected ?string $status = null,
        protected ?string $dateFrom = null,
        protected ?string $dateTo = null
    ) {}

    public function collection()
    {
        $query = Borrowing::with(['details.product', 'creator']);

        if ($this->status) {
            $query->where('status', $this->status);
        }
        if ($this->dateFrom) {
            $query->whereDate('borrow_date', '>=', $this->dateFrom);
        }
        if ($this->dateTo) {
            $query->whereDate('borrow_date', '<=', $this->dateTo);
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nama Peminjam', 'Barang Dipinjam', 'Tanggal Pinjam', 'Tanggal Kembali', 'Status', 'Dibuat Oleh'];
    }

    public function map($borrowing): array
    {
        $items = $borrowing->details->map(function ($d) {
            return $d->product->name . ' (x' . $d->quantity . ')';
        })->implode(', ');

        return [
            $borrowing->id,
            $borrowing->borrower_name,
            $items,
            $borrowing->borrow_date->format('d/m/Y'),
            $borrowing->return_date?->format('d/m/Y') ?? '-',
            ucfirst($borrowing->status),
            $borrowing->creator->name ?? '-',
        ];
    }
}
