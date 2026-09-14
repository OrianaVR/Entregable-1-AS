<?php
// AUTHOR: Maria Laura Tafur Gomez
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
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
            'state' => ['required', 'string'],
            'delivery_date' => ['required', Rule::date()->format('Y-m-d')],
        ];
    }
}
