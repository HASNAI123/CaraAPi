<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RemarkSA;

class ChecklistController extends Controller
{
    public function SAstore(Request $request)
    {
        // Validate the request data if needed
        $validatedData = $request->validate([
            // Define validation rules here
        ]);

        // Retrieve the array of JSON objects from the request
        $dataArray = $request->json()->all();

        // Encode the array as a JSON string
        $encodedData = json_encode($dataArray);

        // Create a new Remark model instance with the encoded data
        $remark = new RemarkSA(['remark_data' => $encodedData]);

        // Save the data to the database
        $remark->save();

        return response()->json([
            'message' => 'Remarks stored successfully',
            'data' => $remark,
        ], 201);
    }

public function index()
{
    // Retrieve all remarks from the database
    $remarks = Remark::all();

    return response()->json([
        'data' => $remarks,
    ]);
}
}
