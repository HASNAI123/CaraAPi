<?php

namespace App\Http\Controllers\Api\v1;


use App\Models\folder_archive;
use App\Models\folder;
use App\Models\Generatesop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFoldersRequest;
use App\Http\Requests\Admin\UpdateFoldersRequest;
use App\Http\Resources\Admin\generatesopResource;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Exports\Generatesop_historyExport;
use Maatwebsite\Excel\Facades\Excel;

class folder_libraryController extends Controller
{
    /**
     * Display a listing of Folder.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $folders = Folder::all();

        return response()->json([
            'success' => true,
            'data' => $folders
        ]);
    }


    /**
     * Show the form for creating new Folder.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(['view' => view('admin.Folders.create')->render()]);
    }

    public function store(Request $request)
    {
        $title = $request->title;
        $password = $request->password;
        $created_by = $request->created_by;

        $folder = Folder::create([
            'title' => $title,
            'password' => $password,
            'created_by' => $created_by,
        ]);

        return response()->json(['success' => true, 'folder' => $folder]);
    }


    public function edit($id)
    {
        $folder=DB::table('folders')->where('id',$id)->get();

        return response()->json(['view' => view('admin.Folders.edit', compact('folder'))->render()]);
    }
    public function update(Request $request, $id)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        if (!$user) {
            return response()->json(['msg' => 'Unauthorized'], 401);
        }

        $query = $user->roles()->pluck('title')->first();
        $folder = Folder::findOrFail($id);

        if ($folder->created_by == $user->name || $query == "Admin") {
            $folder->update([
                'title' => $request->folder_title,
                'password' => $request->password,
            ]);

            return response()->json(['success' => true]);
        } else {
            return response()->json(['msg' => 'This Folder is created by another user'], 403);
        }
    }
    public function show($id)
    {
        $generatesop = DB::table('generatesops')->where('folder',$id)->get();

        return response()->json(['data' => $generatesop]);
    }


    public function check($id)
    {
        $ids=DB::table('folders')->where('id',$id)->get();

        foreach($ids as $id){
            $id->password;

            if($id->password==""){
                $generatesop=DB::table('generatesops')->where('folder',$id->id)->get();
                return response()->json(['view' => view('admin.Folders.show', compact('generatesop'))->render()]);
            } else {
                return response()->json(['view' => view('admin.Folders.password', compact('ids'))->render()]);
            }
        }
    }

    public function showfolder(Request $request)
    {
        $id=$request->id;
        $password=$request->password;
        $title=$request->title;

        $query=DB::table('folders')->where('id',$id)->get();

        foreach ($query as $querys) {
            $check=$password==$querys->password;

            if($check){
                $generatesop=DB::table('generatesops')->where('folder',$id)->get();
                return response()->json(['view' => view('admin.Folders.show', compact('generatesop'))->render()]);
            } else {
                $ids=DB::table('folders')->where('id',$id)->get();
                return response()->json(['view' => view('admin.Folders.password', compact('ids'))->withErrors(['msg' => 'Password Invalid'])]);
            }
        }
    }




    /**
     * Remove Folder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    $folder=DB::table('folders')
        ->where('id',$id)
        ->delete();

    $generatesop= DB::table('generatesops')->where('folder',$id)
        ->select('*')
        ->delete();

    return response()->json(['message' => 'Folder and its related generatesops have been deleted successfully']);
}


public function files($title)
{
    $folder = Folder::findOrFail($title);

    return response()->json(['data' => $folder]);
}


/**
 * Delete all selected Folder at once.
 *
 * @param Request $request
 */
public function massDestroy(Request $request)
{
    if (! Gate::allows('folder_delete')) {
        return response()->json(['message' => 'You are not authorized to perform this action'], 401);
    }
    if ($request->input('ids')) {
        $entries = Folder::whereIn('id', $request->input('ids'))->get();

        foreach ($entries as $entry) {
            $entry->delete();
        }
    }

    return response()->json(['message' => 'Selected folders have been deleted successfully']);
}


/**
 * Restore Folder from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function restore($id)
{
    if (! Gate::allows('folder_delete')) {
        return response()->json(['message' => 'You are not authorized to perform this action'], 401);
    }
    $folder = Folder::onlyTrashed()->findOrFail($id);
    $folder->restore();

    return response()->json(['message' => 'Folder has been restored successfully']);
}

/**
 * Permanently delete Folder from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function deleteFolder($id)
    {
        // Find the folder by ID
        $folder = Folder::find($id);

        // Check if the folder exists
        if (!$folder) {
            return response()->json(['message' => 'Folder not found'], 404);
        }

        // Perform the delete operation
        $folder->delete();

        return response()->json(['message' => 'Folder deleted successfully'], 200);
    }

public function export_generatesop()
{
     return response()->download(new Generatesop_historyExport, 'SOP Library Acknowledgement List.xlsx');
}

}
