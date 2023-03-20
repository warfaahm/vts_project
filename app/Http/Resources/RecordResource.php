<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'next_due_date' => $this->next_due_date,
            'dose_no' => $this->dose_no,
            'patient' => [
                'id' => $this->patient->id,
                'first_name' => $this->patient->first_name,
                'last_name' => $this->patient->last_name,
                'nat_id_no' => $this->patient->nat_id_no,
                'dob' => $this->patient->dob,
                'gender' => $this->patient->gender,
                'allergy' => $this->patient->allergy,
                'phone_no' => $this->patient->phone_no,
            ],
            'dependent' => [
                'id' => $this->dependent->id,
                'first_name' => $this->dependent->first_name,
                'last_name' => $this->dependent->last_name,
                'birth_cert_no' => $this->dependent->birth_cert_no,
                'dob' => $this->dependent->dob,
                'gender' => $this->dependent->gender,
                'allergy' => $this->dependent->allergy,
            ],
            'vaccine' => [
                'id' => $this->vaccine->id,
                'name' => $this->vaccine->vaccine_name,
                'disease' => $this->vaccine->disease->disease_name,
                'validity_duration' => $this->vaccine->validity_duration,
            ],
            'hospital' => [
                'id' => $this->hospital->id,
                'name' => $this->hospital->hospital_name,
            ],
        ];
    }
}
