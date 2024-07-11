<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilesRequest;
use App\Models\Files;
use App\Models\Folder;
use RahulHaque\Filepond\Facades\Filepond;

class FilesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(FilesRequest $request)
    {
        $folderId = Folder::firstWhere("name","=",$request->safe()->only("folder"))->pluck("id");

        if (!$folderId) {
            $project_id = $request->project_id;
            $folderId = Folder::create(["project_id"=>$project_id,"name"=>$request->safe()->only("folder")]);
        }
        Filepond::field($request->names)->moveTo('uploaded/project/' . time());
        Files::create(request()->safe()->except("folder"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Files $files)
    {
        if (request()->user()->cannot('delete', $files)) {
            abort(403);
        }

        $files->delete();
    }
    public function multiple() {
        foreach (request()->ids as $id) {  
            $file = Files::find($id);

            if (request()->user()->cannot('delete', $file)) {
                abort(403);
            }

            $file->delete();
        }
    }
}
