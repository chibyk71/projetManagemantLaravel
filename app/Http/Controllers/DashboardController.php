<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    function __invoke() {
        // Calculate completed projects today
        $completedToday = Project::whereDate('completed_date', now()->toDateString())->count();

        // Calculate pending projects (assuming 'pending' status)
        $pendingProjects = Project::where('status', 'pending')->count();

        // Calculate total projects
        $totalProjects = Project::count();

        // Calculate held projects (assuming 'held' status)
        $heldProjects = Project::where('status', 'held')->count();

         // Get the authenticated user
         $user = Auth::user();

         // Define the project statuses
         $statuses = ['pending', 'completed', 'held', 'in_progress'];
 
         // Initialize the projectsAssignedToMe array
         $projectsAssignedToMe = [];
 
         // Loop through each status and count projects assigned to the user with that status
         foreach ($statuses as $status) {
             $projectsAssignedToMe[$status] = Project::whereHas('assignedUsers', function($query) use ($user) {
                 $query->where('userId', $user->id);
             })->where('status', $status)->count();
         }

        // Pass the variables to the view
        return Inertia::render("Dashboard/Home",["data"=>compact('projectsAssignedToMe','completedToday', 'pendingProjects', 'totalProjects', 'heldProjects')]);
    }
}
