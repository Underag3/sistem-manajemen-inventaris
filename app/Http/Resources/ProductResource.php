<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ],
            'stock' => $this->stock,
            'minimum_stock' => $this->minimum_stock,
            'storage_location' => $this->storage_location,
            'condition' => $this->condition,
            'image_url' => $this->image_url,
            'is_low_stock' => $this->isLowStock(),
            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
        ];
    }
}
