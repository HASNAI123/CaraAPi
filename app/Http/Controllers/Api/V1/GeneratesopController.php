<?php

namespace App\Http\Controllers\Api\v1;
//Soemthing

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Generatesop;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\AwsS3V3\PortableVisibilityConverter;



class GeneratesopController extends Controller
{
    public function index()
    {
        $generatesop = Generatesop::all();

        return response()->json($generatesop);
    }

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|max:500000',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid file'], 400);
        }

        $image = $request->file('image');
        $path = Storage::disk('s3')->putFile('images', $image);
        $url = Storage::disk('s3')->url($path);

        return response()->json(['url' => $url], 200);
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
