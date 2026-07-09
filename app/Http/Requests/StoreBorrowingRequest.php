<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBorrowingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'borrower_name' => 'required|string|max:255',
            'borrow_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'borrower_name.required' => 'Nama peminjam wajib diisi.',
            'borrow_date.required' => 'Tanggal pinjam wajib diisi.',
            'items.required' => 'Minimal satu barang harus dipilih.',
            'items.min' => 'Minimal satu barang harus dipilih.',
            'items.*.product_id.required' => 'Barang wajib dipilih.',
            'items.*.product_id.exists' => 'Barang tidak valid.',
            'items.*.quantity.required' => 'Jumlah wajib diisi.',
            'items.*.quantity.min' => 'Jumlah minimal 1.',
        ];
    }
}
