<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHospitalRequest extends FormRequest
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
            'hospital_name' => ['required', 'string', 'max:255'],
            'phone_no' => ['required', 'string'],
            'address' => ['required', 'string'],
            'slots' => ['required', 'integer'],
            'ward_id' => ['required', 'exists:wards,id'],
        ];
    }
}
