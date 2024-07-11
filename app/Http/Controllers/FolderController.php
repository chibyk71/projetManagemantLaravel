<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(["name" => "required|regex:/^[a-zA-Z0-9_.]+$/|min:4", "project_id" => "required"]);
        Folder::create($validated);

        return back()->with("success","folder created successfully");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Folder $folder)
    {
        $folders = $request->input('folders');

        foreach ($folders as $folder) {
            // Assuming you have a Folder model
            $folderModel = Folder::find($folder['id']);

            if ($folderModel) {
                $folderModel->name = $folder['name'];
                $folderModel->save();
            }
        }

        return redirect()->back()->with('success', 'Folders updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Folder $folder)
    {
        $folder->delete();
    }
}
