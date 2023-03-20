<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\Sub_county;
use App\Models\Ward;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $county = County::all();
        return $this->success($county);
    }

    public function indexWard($id)
    {

        $data = Ward::where('subCounty_id', $id)->get();

        return $this->success($data);
    }

    public function indexSubC($id)
    {
        $data = Sub_county::where('county_id', $id)->get();

        return $this->success($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
