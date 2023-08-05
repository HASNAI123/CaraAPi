<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\folder_archive;
use App\Models\folder_library;
use App\Models\Generatesop;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Http\Requests\Admin\StoreFoldersRequest;
use App\Http\Requests\Admin\UpdateFoldersRequest;
use App\Http\Resources\Admin\generatesopResource;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

//random

class folder_archiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
{
    $archive_folders = folder_archive::all();
    return response()->json(['archive_folders' => $archive_folders]);
}


    /**
     * Show the form for creating new Folder.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        return response()->json(['message' => 'Method not allowed'], 405);
    }

    /**
     * Store a newly created Folder in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $title = $request->title;
        $password = $request->password;
        $created_by = $request->created_by;

        $folder = folder_archive::create([
            'title' => $title,
            'password' => $password,
            'created_by' => $created_by,
        ]);

        return response()->json(['success' => true, 'folder' => $folder]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $sop = DB::table('sop')->where('archive_folder', $id)->get();
        return response()->json(['sop' => $sop]);
    }

    /**
     * Show the form for editing Folder.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        return response()->json(['message' => 'Method not allowed'], 405);
    }

    /**
     * Update Folder in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $folder = folder_archive::findOrFail($id);

        $folder->update([
            'title' => $request->folder_title,
            'password' => $request->password,
        ]);

        // Retrieve the updated folder again to include the updated data in the response
        $updatedFolder = folder_archive::findOrFail($id);

        return response()->json([
            'success' => true,
            'folder' => $updatedFolder,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFolder($id)
{
     // Find the folder by ID
     $folder = folder_archive::find($id);

     // Check if the folder exists
     if (!$folder) {
         return response()->json(['message' => 'Folder not found'], 404);
     }

     // Perform the delete operation
     $folder->delete();

     return response()->json(['message' => 'Folder deleted successfully'], 200);
}
}
