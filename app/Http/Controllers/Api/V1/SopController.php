<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Sop;
use App\Models\Generatesop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SopController extends Controller
{
    public function getSop()
    {
        $sops = Sop::all();

        return response()->json($sops);
    }

    public function getAllGeneratedSops()
    {
        $sops = Generatesop::all();

        return response()->json($sops);
    }
}
