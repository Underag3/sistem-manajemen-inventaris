<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BorrowingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'borrower_name' => $this->borrower_name,
            'borrow_date' => $this->borrow_date->toDateString(),
            'return_date' => $this->return_date?->toDateString(),
            'status' => $this->status,
            'created_by' => [
                'id' => $this->creator->id,
                'name' => $this->creator->name,
            ],
            'items' => $this->details->map(function ($detail) {
                return [
                    'id' => $detail->id,
                    'product' => [
                        'id' => $detail->product->id,
                        'code' => $detail->product->code,
                        'name' => $detail->product->name,
                    ],
                    'quantity' => $detail->quantity,
                    'status' => $detail->status,
                ];
            }),
            'created_at' => $this->created_at->toISOString(),
        ];
    }
}
