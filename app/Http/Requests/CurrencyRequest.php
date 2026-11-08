<?php

/**
 * @author Maria Laura Tafur Gomez
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'currency' => ['required', 'in:USD,COP'],
        ];
    }
}
