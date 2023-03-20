<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'time' => ['required', 'time'],
            'dose_no' => ['required'],
            'status' => ['required'],
            'hospital_id' => ['required', 'exists:hospitals,id'],
            'dependent_id' => ['exists:dependents,id'],
            'vaccine_id' => ['required', 'exists:vaccines,id'],
        ];
    }
}
