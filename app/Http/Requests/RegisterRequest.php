<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:5'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'size:6'],
            'address' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'int', 'min:10'],
        ];
    }
}
