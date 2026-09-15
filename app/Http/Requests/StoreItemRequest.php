<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quantity' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'numeric'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'order_id' => ['required', 'integer', 'exists:orders,id'],
        ];
    }
}
