<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Inertia\Inertia;

class ProjectInfoController extends Controller
{
    public function milestones(Project $project) {
        $milestones = $project->milestones()->with('contractors:id,name')->paginate(50);

         // Format the result
         $datas["milestones"] = $milestones->map(function ($milestone) use ($project) {
            return [
                'id' => $milestone->id,
                'name' => $milestone->name,
                "status"=> $milestone->status,
                "progress" => $milestone->progress,
                "projectId" => $project->id,
                'contractor' => $milestone->contractors->only(["id","name"]),
            ];
        });

        // Add pagination details
        $datas['pagination'] = [
            'total' => $milestones->total(),
            'next_url' => $milestones->nextPageUrl(),
            'previous_url' => $milestones->previousPageUrl(),
        ];

        return Inertia::render("Dashboard/Projects/Id/Milestones", compact("datas"));
    }

    public function details(Project $project) {
        $details = $project->pluck("description");
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
                        "uploadedBy" => $file->uploadedBy->only(["id","name","avatar"]),
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