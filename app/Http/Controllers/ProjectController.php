<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Contractor;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Fetch the projects with assigned users
        $projects = Project::with(["milestones","assignedUsers","folders"])->paginate(50);

        // Transform the projects to the desired format
        $transformedProjects = $projects->getCollection()->transform(function ($project) {
            return [
                'id' => $project->id,
                'title' => (string) $project->title,
                'contractor' => $project->contractors->only(["id", "name"]),
                'start_date' => (string) $project->start_date,
                'due_date' => (string) $project->due_date,
                'canceled_date' => $project->canceled_date ? (string) $project->canceled_date : null,
                'completed_date' => $project->completed_date ? (string) $project->completed_date : null,
                'status' => (string) $project->status,
                'progress' => (string) $project->progress,
                'description' => (string) $project->description,
                'created_by_id' => (string) $project->created_by_id,
                'contract_sum' => (string) $project->contract_sum,
                'date_of_award' => (string) $project->date_of_award,
                'duration' => $project->duration ? (string) $project->duration : null,
                'project_number' => (string) $project->project_number, // Assuming you have a relationship with Contractor
                'milestones' => $project->milestones->count(),
                "files" => $project->folders->files->count(),
                'team' => $project->assignedUsers->map(function ($user) {
                    return [
                        'id' => (string) $user->id,
                        'name' => (string) $user->name,
                        "avatar" => (string) $user->avatar
                    ];
                })->toArray(), // Assuming assignedUsers has a name attribute
            ];
        });

        // Set the transformed projects back to the paginator
        $projects->setCollection($transformedProjects);

        $status = ['IN_PROGRESS', 'ON_HOLD', 'COMPLETED', 'NOT_STARTED', 'CANCELED'];

        $data = array();

        foreach ($status as $stage) {
            $data[strtolower($stage)] = Project::where("status", "=", $stage)->count();
        }

        $data["all"] = Project::count();

        $data["projects"] = $projects;

        return Inertia::render("Dashboard/Projects/Page", compact("data"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $projectData = $request->validated();
        $contractor = $projectData["contractor"];
        $contractor_id = Contractor::where("name", "=", $contractor)->pluck("id")->first();

        if (!$contractor_id) {
            $contractor = Contractor::create(["name" => $contractor]);
            $contractor_id = $contractor->id;
        }

        $projectData["contractor_id"] = $contractor_id;
        unset($projectData["contractor"]);

        Project::create($projectData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // Transform the projects to the desired format
        $transformedProject = [
            'id' => $project->id,
            'title' => (string) $project->title,
            'contractor' => $project->contractors->only(["id", "name"]),
            'start_date' => $project->start_date,
            'due_date' => $project->due_date,
            'canceled_date' => $project->canceled_date ? (string) $project->canceled_date : null,
            'completed_date' => $project->completed_date ? (string) $project->completed_date : null,
            'status' => (string) $project->status,
            'progress' => $project->progress,
            'description' => (string) $project->description,
            'created_by_id' => (string) $project->created_by_id,
            'contract_sum' => (string) $project->contract_sum,
            'date_of_award' => (string) $project->date_of_award,
            'duration' => $project->duration ? (string) $project->duration : null,
            'project_number' => (string) $project->project_number, // Assuming you have a relationship with Contractor
            'milestones' => $project->milestones,
            'team' => $project->assignedUsers->map(function ($user) {
                return [
                    'id' => (string) $user->id,
                    'name' => (string) $user->name,
                    "avatar" => (string) $user->avatar
                ];
            })->toArray(), // Assuming assignedUsers has a name attribute
        ];

        return Inertia::render("Dashboard/Projects/Id/OverView", ["project"=>$transformedProject]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
    }

    public function DeleteMany(Request $request)
    {
        // Validate the request to ensure 'project_ids' is an array
        $request->validate([
            'projectIds' => 'required|array',
            'projectIds.*' => 'exists:projects,id', // Ensure each project ID exists in the database
        ]);

        $projectIds = $request->input('projectIds');

        DB::beginTransaction();

        try {
            foreach ($projectIds as $projectId) {
                $project = Project::findOrFail($projectId);
                $project->delete();
            }

            DB::commit();
            return response()->json(['message' => 'All projects deleted successfully.', "status" => "success"], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            // Log the error
            Log::error('Failed to delete projects', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Failed to delete all projects. No projects were deleted.',
                'error' => $e->getMessage(),
                "status" => "error"
            ], 500);
        }
    }

    public function changeStates(Request $request)
    {
        $validated = $request->validate([
            "status" => "required|in:IN_PROGRESS,ON_HOLD,COMPLETED,NOT_STARTED,CANCELED",
            "projectIds" => "required|array",
            "projectIds.*" => "numeric|exists:projects,id"
        ]);

        $status = $validated["status"];
        $projectIds = $validated["projectIds"];

        DB::beginTransaction();

        try {
            foreach ($projectIds as $projectId) {
                $project = Project::findOrFail($projectId);

                $progress = null;
                if ($status === 'COMPLETED') {
                    $progress = 100;
                } elseif ($status === 'NOT_STARTED') {
                    $progress = 0;
                }

                if ($progress !== null) {
                    $project->progress = $progress;
                }
                $project->status = $status;

                $project->save();
            }

            DB::commit();
            return response()->json(['message' => 'All projects updated successfully.',"status"=>true], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            // Log the error
            Log::error('Failed to update projects', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Failed to update all projects. No projects were updated.',
                'error' => $e->getMessage(),
                "status"=>false
            ], 500);
        }
    }


    public function updateAssign(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'assigned' => 'required|array',
            'assigned.*' => 'exists:users,id', // Ensure each user ID exists in the users table
            "projectIds" => "required|array",
            "projectIds.*" => "numeric|exists: projects,id"
        ]);

        DB::beginTransaction();

        $assigned = $validatedData["assigned"];
        $projectIds = $validatedData["projectIds"];

        try {
            foreach ($projectIds as $id) {
                // Find the project
                $project = Project::findOrFail($id);

                // Update the assigned users
                $project->assignedUsers()->sync($validatedData['assigned']);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            // Log the error
            Log::error('Failed to update projects', ['error' => $th->getMessage()]);
            return response()->json([
                'message' => 'Failed to update all projects. No projects were updated.',
                'error' => $th->getMessage(),
                "status"=>false
            ], 500);
        }
    }
}
