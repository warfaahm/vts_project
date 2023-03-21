<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProviderRequest extends FormRequest
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
            'name' =>['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:healthcare_providers'],
            'password' => ['required', 'min:6', 'string'],
            'role' => ['required', 'in:admin,staff'],
            'hospital_id' => ['required', 'exists:hospitals,id'],
        ];
    }
}
