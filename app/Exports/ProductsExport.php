<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(
        protected ?string $categoryId = null,
        protected ?string $condition = null
    ) {}

    public function collection()
    {
        $query = Product::with('category');

        if ($this->categoryId) {
            $query->where('category_id', $this->categoryId);
        }
        if ($this->condition) {
            $query->where('condition', $this->condition);
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return ['Kode Barang', 'Nama Barang', 'Kategori', 'Stok', 'Stok Minimum', 'Lokasi Penyimpanan', 'Kondisi', 'Tanggal Dibuat'];
    }

    public function map($product): array
    {
        return [
            $product->code,
            $product->name,
            $product->category->name ?? '-',
            $product->stock,
            $product->minimum_stock,
            $product->storage_location,
            $product->condition,
            $product->created_at->format('d/m/Y'),
        ];
    }
}
