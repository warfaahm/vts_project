<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecordRequest;
use App\Http\Resources\RecordResource;
use App\Models\Dependent;
use App\Models\Record;
use App\Models\Vaccine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RecordResource::collection();
    }

    public function indexForPatient()
    {
        return RecordResource::collection(
            Record::where('patient_id', Auth::user()->id)->get()
        );
    }

    public function indexForDependent()
    {
        return RecordResource::collection(
            Record::where('dependent_id', Auth::user()->dependents()->id)->get()
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecordRequest $request)
    {
        $request->validated($request->all());

        $vaccine = Vaccine::findOrFail($request->vaccine_id);
        $dosage = $vaccine->dosage;
        $duration1 = $vaccine->dose_1_duration;
        $duration2 = $vaccine->dose_2_duration;
        $duration3 = $vaccine->dose_3_duration;

        if ($dosage == $request->dose_no) {
            $next_date = null;
        }
        elseif ($dosage > $request->dose_no && $request->dose_no == 1 ){
            $next_date = Carbon::parse($request->date)->addDays($duration1 * 7);
        }
        elseif ($dosage > $request->dose_no && $request->dose_no == 2 ){
            $next_date = Carbon::parse($request->date)->addDays($duration2 * 7);
        }
        elseif ($dosage > $request->dose_no && $request->dose_no == 3 ){
            $next_date = Carbon::parse($request->date)->addDays($duration3 * 7);
        }

        $record = Record::create([
            'hospital_id' => Auth::user()->hospital_id,
            'date' => $request->date,
            'next_due_date' => $next_date,
            'dose_no' => $request->dose_no,
            'patient_id' => $request->patient_id,
            'dependent_id' => $request->dependent_id,
            'vaccine_id' => $request->vaccine_id,
        ]);

        return new RecordResource($record);
    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record)
    {
        return new RecordResource($record);
    }

    public function showForPatient(Record $record)
    {
        if (Auth::user()->id !== $record->patient_id){
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        return new RecordResource($record);
    }

    public function showForDependent(Dependent $dependent, Record $record)
    {
        if (Auth::user()->id !== $dependent->patient_id){
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        $record = $dependent->records()->findOrFail($record->id);

        return new RecordResource($record);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Record $record)
    {
        $currentDate = today();
        if (Auth::user()->hospital_id !== $record->hospital_id  && $record->date !== $currentDate){
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        $record->update($request->all());

        return new RecordResource($record);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
