<?php

/**
 * @author Maria Laura Tafur Gomez
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'password' => ['nullable', 'string'],
            'email' => ['required', 'string', 'email'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string'],
        ];
    }
}
