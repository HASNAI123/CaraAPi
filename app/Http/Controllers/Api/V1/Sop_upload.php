<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sop;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



class Sop_upload extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uploaded_by' => 'required|string',
            'sop_title' => 'required|string',
            'business_unit' => 'required|string',
            'sop_file' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $sop = new Sop;

        $sop->uploaded_by = $request->uploaded_by;
        $sop->sop_title = $request->sop_title;
        $sop->business_unit = $request->business_unit;

        // Save the SOP record in the database
        $sop->save();

        return response()->json(['message' => 'SOP uploaded successfully', 'sop' => $sop], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve and return the specific SOP record based on the given ID
        $sop = Sop::find($id);
        if ($sop) {
            return response()->json(['sop' => $sop], 200);
        } else {
            return response()->json(['error' => 'SOP not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'uploaded_by' => 'required|string',
            'date' => 'required|date',
            'sop_title' => 'required|string',
            'business_unit' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $sop = Sop::find($id);
        if ($sop) {
            // Update the SOP record with the new values
            $sop->update($request->all());

            return response()->json(['message' => 'SOP updated successfully', 'sop' => $sop], 200);
        } else {
            return response()->json(['error' => 'SOP not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sop = Sop::find($id);
        if ($sop) {
            // Delete the SOP record from the database
            $sop->delete();

            return response()->json(['message' => 'SOP deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'SOP not found'], 404);
        }
    }
}
