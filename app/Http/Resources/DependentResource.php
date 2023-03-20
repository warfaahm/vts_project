<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DependentResource extends JsonResource
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
            'dependent' => [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'birth_cert_no' => $this->birth_cert_no,
                'gender' => $this->gender,
                'allergy' => $this->allergy,
                'dob' => $this->dob,
                'relationship' => $this->relationship,
            ],
            'parent' => [
                'id' => $this->patient->id,
                'first_name' => $this->patient->first_name,
                'last_name' => $this->patient->last_name,
                'nat_id_no' => $this->patient->nat_id_no,
                'phone_no' => $this->patient->phone_no,
            ],
        ];
    }
}
