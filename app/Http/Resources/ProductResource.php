<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'brand' => $this->getBrand(),
            'price' => $this->getPrice(),
            'stock' => $this->getStock(),
            'category' => $this->getCategory()->getName(),
            'image' => asset('images/products/'.$this->getImage()),
            'url' => route('product.show', ['id' => $this->getId()]),
        ];
    }
}
