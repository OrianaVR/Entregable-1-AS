<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'address' => ['required', 'string'],
            'delivery_date' => ['required', Rule::date()->format('Y-m-d')],
            'payment_method' => ['required', 'string'],
        ];
    }
}
