<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AppointmentResource::collection(
            Appointment::where('hospital_id', Auth::user()->hospital_id)->orderBy('date', 'desc')->get()
        );
    }

    public function indexForUser()
    {
        return AppointmentResource::collection(
            Appointment::where('patient_id', Auth::user()->id)->orderBy('date', 'desc')->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        $request->validated($request->all());

        $appointment = Appointment::create([
            'patient_id' => Auth::user()->id,
            'date' => $request->date,
            'time' => $request->time,
            'dose_no' => $request->dose_no,
            'status' => $request->status,
            'hospital_id' => $request->hospital_id,
            'dependent_id' => $request->dependent_id,
            'vaccine_id' => $request->vaccine_id,

        ]);

        return new AppointmentResource($appointment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        if (Auth::user()->hospital_id !== $appointment->hospital_id){
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        return new AppointmentResource($appointment);
    }

    public function showUser(Appointment $appointment)
    {
        if (Auth::user()->id !== $appointment->patient_id){
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        return new AppointmentResource($appointment);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        if (Auth::user()->hospital_id !== $appointment->hospital_id){
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        $appointment->update($request->all());
        return new AppointmentResource($appointment);
    }

    public function updateUser(Request $request, Appointment $appointment)
    {
        $currentDate = today();
        if (Auth::user()->id !== $appointment->patient_id && $appointment->date <= $currentDate){
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        $appointment->update($request->all());

        return new AppointmentResource($appointment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
