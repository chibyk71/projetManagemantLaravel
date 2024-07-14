<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use App\Models\Milestone;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $milestones = Project::find(request()->id)->milestones()->paginate(50);

        return Inertia::render("Dashboard/Projects/Id/Milestones", compact("milestones"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string',
            'status' => 'required|in:IN_PROGRESS,YET_TO_COMMENCE,COMPLETED',
            'progress' => 'required|numeric',
            'contractor' => 'required|string',
            "projectId" => "required|integer"
        ]);

        // Find the contractor by name
        $contractor = Contractor::firstWhere("name", "=", $validated["contractor"]);

        // If the contractor doesn't exist, create a new one
        if (!$contractor) {
            $contractor = Contractor::create(["name" => $validated["contractor"]]);
        }

        // Get the contractor's ID
        $validated["contractorId"] = $contractor->id;

        // Create a new Milestone with the validated data
        Milestone::create($validated);

        // Redirect back with a success message
        // return redirect()->back()->with('success', 'Validation passed!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Milestone $milestone)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'status' => 'required|in:IN_PROGRESS,YET_TO_COMMENCE,COMPLETED',
            'progress' => 'required|numeric',
            'contractor' => 'required|string',
            "projectId" => "required|integer"
        ]);

        $contractor_id = Contractor::where("name", "=", $validated["contractor"])->pluck("id");

        if (!$contractor_id) {
            $contractor_id = Contractor::create(["name" => $validated["contractor"]]);
        }

        $validated["contractorId"] = $contractor_id;

        $milestone->update($validated);

        return redirect()->back()->with('success', 'Validation passed!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Milestone $milestone)
    {
        $milestone->delete();
    }
}
