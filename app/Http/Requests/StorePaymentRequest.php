<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'method' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'status' => ['required', 'string', 'max:255'],
            'transaction_code' => ['required', 'integer'],
            'order_id' => ['required', 'integer', 'exists:orders,id'],
        ];
    }
}
