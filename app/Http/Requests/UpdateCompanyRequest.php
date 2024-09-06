<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
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
        // Get the company ID from the route
        $companyId = $this->route('company')->id;

        return [
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg', 'max:2048'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('companies')->ignore($companyId), // Ignore the current company ID
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('companies')->ignore($companyId), // Ignore the current company ID
            ],
        ];
    }
}
