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



}
