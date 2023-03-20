<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHospitalRequest;
use App\Http\Resources\HospitalResource;
use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = HospitalResource::collection(Hospital::all());
        return $this->success($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHospitalRequest $request)
    {
        $request->validated($request->all());

        $hospital = Hospital::create([
            'hospital_name' => $request->hospital_name,
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            'slots' => $request->slots,
            'ward_id' => $request->ward_id,
        ]);

        $data = new HospitalResource($hospital);
        return $this->success($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hospital $hospital)
    {
        $data = new HospitalResource($hospital);
        return $this->success($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hospital $hospital)
    {
        $hospital->update($request->all());

        $data =  new HospitalResource($hospital);
        return $this->success($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
