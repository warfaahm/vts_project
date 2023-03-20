<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDependentRequest;
use App\Http\Resources\DependentResource;
use App\Models\Dependent;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DependentController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DependentResource::collection(
            Dependent::where('patient_id', Auth::user()->id)->get()
        );

        return $this->success($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDependentRequest $request)
    {
        $request->validated($request->all());

        $dependent = Dependent::create([
            'patient_id' => Auth::user()->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birth_cert_no' => $request->birth_cert_no,
            'gender' => $request->gender,
            'allergy' => $request->allergy,
            'dob' => $request->dob,
            'relationship' => $request->relationship,
        ]);

        return new DependentResource($dependent);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dependent $dependent)
    {
        if (Auth::user()->id !== $dependent->patient_id){
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        if (!$dependent){
            return $this->error(null, 'Dependent not found', 404);
        }

        $data = new DependentResource($dependent);
        return $this->success($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dependent $dependent)
    {
        if (Auth::user()->id !== $dependent->patient_id){
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        $dependent->update($request->all());

        return new DependentResource($dependent);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
