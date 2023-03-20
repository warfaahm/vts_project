<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\Request;

class CountyController extends Controller
{
    //
    public function addCounty(Request $request)
    {
        $validatedData = $request->validate([
            'county_name' => 'required|string',
        ]);

        $county = new County([
            'county_name' => $validatedData['county_name'],
        ]);

        $county->save();

        return response()->json([
            'message' => 'County added successfully',
            'data' => $county,
        ]);
    }

    public function viewCounty($id)
    {
        $county = County::find($id);

        if (!$county){
            return response()->json([
                'success' => false,
                'message' => 'County not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $county,
        ]);
    }

    public function index()
    {
        $county = County::all();

        return response()->json([
            'success' => true,
            'data' => $county,
        ]);
    }
}
