<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VaccineResource extends JsonResource
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
            'name' => $this->vaccine_name,
            'manufacturer' => $this->manufacturer,
            'contains' => $this->contains,
            'dosage' => $this->dosage,
            'age_range' => $this->age_range,
            'duration_1' => $this->dose_1_duration,
            'duration_2' => $this->dose_2_duration,
            'duration_3' => $this->dose_3_duration,
            'validity_duration' => $this->validity_duration,
            'price' => $this->price,
            'disease' => $this->diseases,
        ];
    }
}
