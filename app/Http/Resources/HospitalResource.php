<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HospitalResource extends JsonResource
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
            'name' => $this->hospital_name,
            'phone_no' => $this->phone_no,
            'address' => $this->address,
            'slots' => $this->slots,
            'ward' => $this->ward,

        ];
    }
}
