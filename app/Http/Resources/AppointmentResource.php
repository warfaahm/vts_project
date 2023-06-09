<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            'time' => $this->time,
            'dose_no' => $this->dose_no,
            'status' => $this->status,
            'patient' => $this->patient,
            'dependent' => $this->dependent,
            'vaccine' => $this->vaccine,
            'hospital' => $this->hospital,
        ];
    }
}
