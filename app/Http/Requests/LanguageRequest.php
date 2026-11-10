<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'locale' => ['required', 'in:en,es'],
        ];
    }
}
