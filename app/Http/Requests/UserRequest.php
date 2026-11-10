<?php

/**
 * @author Maria Laura Tafur Gomez
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'password' => [$this->isMethod('put') ? 'nullable' : 'required', 'string', 'size:6'],
            'email' => ['required', 'string', 'email'],
            'address' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'int', 'min:10'],
            'role' => ['required', 'string'],
        ];
    }
}
