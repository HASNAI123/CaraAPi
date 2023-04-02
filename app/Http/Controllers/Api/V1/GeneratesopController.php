<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generatesop;

class GeneratesopController extends Controller
{
    public function index()
    {
        $generatesop = Generatesop::all();

        return response()->json($generatesop);
    }

    public function show($id)
    {
        $generatesop = Generatesop::find($id);

        if (!$generatesop) {
            return response()->json(['error' => 'Generatesop not found.'], 404);
        }

        return response()->json($generatesop);
    }

    public function store(Request $request)
    {
        $generatesop = new Generatesop($request->all());

        $generatesop->save();

        return response()->json($generatesop, 201);
    }

    public function update(Request $request, $id)
    {
        $generatesop = Generatesop::find($id);

        if (!$generatesop) {
            return response()->json(['error' => 'Generatesop not found.'], 404);
        }

        $generatesop->fill($request->all());

        $generatesop->save();

        return response()->json($generatesop);
    }

    public function destroy($id)
    {
        $generatesop = Generatesop::find($id);

        if (!$generatesop) {
            return response()->json(['error' => 'Generatesop not found.'], 404);
        }

        $generatesop->delete();

        return response()->json(['message' => 'Generatesop deleted.']);
    }

}
