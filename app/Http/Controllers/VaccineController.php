<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVaccineRequest;
use App\Http\Resources\VaccineResource;
use App\Models\Vaccine;
use Illuminate\Http\Request;

class VaccineController extends Controller
{

    public function store(StoreVaccineRequest $request)
    {
        $request->validated($request->all());

        $vaccine = Vaccine::create([
            'vaccine_name' => $request->vaccine_name,
            'manufacturer' => $request->manufacturer,
            'contains' => $request->contains,
            'dosage' => $request->dosage,
            'age_range' => $request->age_range,
            'dose_1_duration' => $request->dose_1_duration,
            'dose_2_duration' => $request->dose_2_duration,
            'dose_3_duration' => $request->dose_3_duration,
            'validity_duration' => $request->validity_duration,
            'price' => $request->price,
        ]);
        $vaccine->diseases()->attach($request->disease_id);

        $data = new VaccineResource($vaccine);
        return $this->success($data);
    }
}
