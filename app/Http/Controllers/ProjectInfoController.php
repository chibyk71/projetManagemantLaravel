<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProjectInfoController extends Controller
{
    public function milestones(Project $project) {
        $milstones = $project->milestones()->paginate(50);

        return Inertia::render("Dashboard/Projects/Id/Milestones", compact("milestones"));
    }

    public function details(Project $project) {
        $details = $project->pluck("desc");
        $user = request()->user();

        $isPermited = $user->hasPermissionTo("edit projects") || $user->id === $project->createdBy;

        return Inertia::render("Dashboard/Projects/Id/Details", compact("details","isPermited"));
    }

    public function files(Project $project) {
        $folders = $project->folders()->get();

         // Format the result
         $data = $folders->map(function ($folder) use ($project) {
            $paginatedFiles = $folder->files()->paginate(30);

            return [
                'id' => $folder->id,
                'name' => $folder->name,
                "projectId" => $project->id,
                'files' => $paginatedFiles->map(function ($file) {
                    return [
                        'id' => $file->id,
                        'name' => $file->name,
                        "uploadedBy" => $file->uploadedBy()->only(["id","name","avatar"]),
                        "date_uploaded" => $file->created_at,
                    ];
                }),
                // Add pagination details
                'files_pagination' => [
                    'total' => $paginatedFiles->total(),
                    'next_url' => $paginatedFiles->nextPageUrl(),
                    'previous_url' => $paginatedFiles->previousPageUrl(),
                ]
            ];
        });

        return Inertia::render("Dashboard/Projects/Id/Files", compact("data"));
    }
}