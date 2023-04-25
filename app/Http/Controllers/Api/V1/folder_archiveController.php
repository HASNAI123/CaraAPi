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
        $title = $request->input('title');
        $password = $request->input('password');
        $user = Auth::user()->name;

        $archive_folder = Archive_Folder::create([
            'title' => $title,
            'password' => $password,
            'created_by' => $user,
        ]);

        return response()->json(['archive_folder' => $archive_folder], 201);
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
        $user = Auth::user()->name;

        $query = DB::table('roles')
            ->select('roles.title')
            ->join('role_user', 'role_user.role_id', '=', 'roles.id')
            ->where('role_user.user_id', '=', Auth::user()->id)
            ->first();

        $folder = $ids = DB::table('archive_folders')->where('id', $id)->first();

        if ($folder->created_by == $user || $query->title == "Admin") {
            DB::table('archive_folders')
                ->where('id', $id)
                ->limit(1)
                ->update(array('title' => $request->input('folder_title'), 'password' => $request->input('password')));

            return response()->json(['message' => 'Folder updated successfully']);
        } else {
            return response()->json(['message' => 'This Folder is created by another user'], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
{
    $user = Auth::user()->name;
    $query = DB::table('roles')
        ->select('roles.title')
        ->join('role_user', 'role_user.role_id', '=', 'roles.id')
        ->where('role_user.user_id', '=', Auth::user()->id)
        ->first();
    $folder = DB::table('archive_folders')->where('id', $id)->first();
    if ($folder->created_by == $user || $query->title == "Admin") {
        DB::table('archive_folders')->where('id', $id)->delete();
        return response()->json(['message' => 'Folder successfully deleted.']);
    } else {
        return response()->json(['error' => 'You are not authorized to delete this folder.'], 403);
    }
}
}
