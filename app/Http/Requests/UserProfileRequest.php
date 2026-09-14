<?php
// AUTHOR: Maria Laura Tafur Gomez
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
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
