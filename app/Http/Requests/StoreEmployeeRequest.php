<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'company_id' => ['required', 'integer', 'exists:companies,id'], // assumes a "companies" table
            'email' => ['required', 'string', 'email', 'max:255', 'unique:employees,email'], // unique in the "employees" table
            'phone' => ['required', 'string', 'regex:/^\+?[0-9\-]{7,15}$/'], // phone is can have digits, hyphens, and an optional "+" prefix
        ];
    }
}
