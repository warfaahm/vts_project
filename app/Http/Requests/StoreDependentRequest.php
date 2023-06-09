<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDependentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birth_cert_no' => ['required', 'string', 'unique:dependents', 'max:100'],
            'gender' => ['required', 'in:M,F'],
            'allergy' => ['string', 'max:255'],
            'dob' => ['required', 'date'],
            'relationship' => ['required', 'string', 'max:100'],
        ];
    }
}
