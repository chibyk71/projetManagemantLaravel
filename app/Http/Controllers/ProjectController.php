<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(50);
        $status = ['IN_PROGRESS','ON_HOLD','COMPLETED','NOT_STARTED','CANCELED'];

        $data = array();

        foreach ($status as $stage) {
            $data[strtolower($stage)] = Project::where("status","=",$stage)->count();
        }

        $data["all"] = Project::count();

        $data["projects"] = $projects;

        return Inertia::render("Dashboard/Projects/Page", compact("data"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request){
        Project::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project = $project::with("assignedUser");
        return Inertia::render("Dashboard/Projects/Id/OverView",compact("project"));
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
}
