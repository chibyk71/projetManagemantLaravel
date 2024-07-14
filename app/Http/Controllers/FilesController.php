<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RahulHaque\Filepond\Facades\Filepond;

class FilesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        try { 
            $validated = $request->validate([
                "stage" => ['required', "in:BEFORE,DURING,COMPLETE"],
                "names" => "required|array",
                "names.*" => ["required"],
                "folder" => "required|regex:/([a-zA-Z0-9_.\s]+)$/",
                "project_id" => "required|integer" // Ensure project_id is included in validation
            ]);
            

            // Retrieve folder ID
            $folderName = $validated["folder"];
            $folder = Folder::firstWhere("name", "=", $folderName);
            $folderId = $folder ? $folder->id : null;

            // If folder does not exist, create it
            if (!$folderId) {
                $project_id = $validated['project_id'];
                $folder = Folder::create(["project_id" => $project_id, "name" => $folderName]);
                $folderId = $folder->id;
            }
    
            // Move files to the specified location
            // Populate validatedData
            $validatedData = $request->except(["folder", "project_id"]);
            $validatedData["folder_id"] = $folderId;
            $validatedData["userId"] = $request->user()->id;
            
            foreach ($validated["names"] as $file) {
                $filedetails = Filepond::field($file)->moveTo('project/' . uniqid());
                $validatedData["name"] = $filedetails["location"];
                // Create the file record
                Files::create($validatedData);
            }
        } catch (\Throwable $th) {
            Log::error('Error in file upload: ' . $th->getMessage());
        }
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
    public function multiple()
    {
        foreach (request()->ids as $id) {
            $file = Files::find($id);

            if (request()->user()->cannot('delete', $file)) {
                abort(403);
            }

            $file->delete();
        }
    }
}
