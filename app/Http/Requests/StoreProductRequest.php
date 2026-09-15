<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'price' => ['required', 'numeric', 'gt:0'],
            'description' => ['required', 'string'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,svg,webp', 'max:2048'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }
}
