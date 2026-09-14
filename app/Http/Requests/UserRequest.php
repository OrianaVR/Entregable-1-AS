<?php
// AUTHOR: Maria Laura Tafur Gomez
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'password' => ['required', 'string', 'size:6'],
            'email' => ['required', 'string'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'role' => ['required', 'string'],
        ];
    }
}
