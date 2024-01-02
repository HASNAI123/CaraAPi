<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Acknowledgment;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AcknowledgmentExport;

class AcknowlegdementController extends Controller
{
    public function All_reports()
    {
        return Excel::download(new AcknowledgmentExport, 'acknowledgments.xlsx');
    }

    public function store(Request $request)
    {
        $request->validate([
            'User_id' => 'required',
            'user_name' => 'required',
            'Terms_1' => 'required',
            'Terms_2' => 'nullable',
            'Date_Downloaded' => 'date',
            'Type' => 'nullable'
        ]);

        Acknowledgment::create([
            'User_id' => $request->input('User_id'),
            'user_name' => $request->input('user_name'),
            'Terms_1' => $request->input('Terms_1'),
            'Terms_2' => $request->input('Terms_2'),
            'Date_Downloaded' => $request->input('Date_Downloaded') ?? now(),
            'Type' => $request->input('Type')
        ]);

        return response()->json(['message' => 'Data saved successfully'], 201);
    }



}
