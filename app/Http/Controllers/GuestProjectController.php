<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Settings\WebsiteSetting;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use function PHPSTORM_META\map;

class GuestProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects = Project::with('folders')->paginate(50);

        $projects->getCollection()->transform(function ($project) {
            $description = strip_tags($project->desc);
            $description = implode(' ', array_slice(explode(' ', $description), 0, 20));

            $firstImage = null;

            foreach ($project->folders as $folder) {
                if ($folder->files->isNotEmpty()) {
                    $firstImage = $folder->files->first()->name;
                    break;
                }
            }

            return [
                "id" => $project->id,
                'title' => $project->title,
                'progress' => $project->progress,
                'status' => $project->status,
                'description' => $description,
                'image' => $firstImage,
            ];
        });

        return Inertia::render('project/Page', ['projects' => $projects]);
    }

    public function home(WebsiteSetting $websiteSetting)
    {
        $projects = Project::with('folders.files')->paginate(12);

        $projects->getCollection()->transform(function ($project) {
            $description = strip_tags($project->desc);
            $description = implode(' ', array_slice(explode(' ', $description), 0, 20));

            $firstImage = null;

            foreach ($project->folders as $folder) {
                if ($folder->files->isNotEmpty()) {
                    $firstImage = $folder->files->first()->name;
                    break;
                }
            }

            return [
                "id" => $project->id,
                'title' => $project->title,
                'progress' => $project->progress,
                'status' => $project->status,
                'description' => $description,
                'image' => $firstImage,
            ];
        });
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            "projects" => $projects,
            "title" => $websiteSetting->front_page_heading,
            "front_img"=> $websiteSetting->front_img,
            "subheading"=> $websiteSetting->front_page_subheading
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load(['folders.files', "milestones"]);


        $imagesGroupedByStage = $project->folders->flatMap->files->groupBy('stage');

        $stages = $imagesGroupedByStage->map(function ($files, $stage) {
            // Custom pagination logic
            $page = request()->get('page', 1);
            $perPage = 30;
            $total = $files->count();
            $sliced = $files->slice(($page - 1) * $perPage, $perPage);

            $paginatedImages = new \Illuminate\Pagination\LengthAwarePaginator(
                $sliced->map->only('name'),
                $total,
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );

            return [
                'total' => $paginatedImages->total(),
                'current_page' => $paginatedImages->currentPage(),
                'next_page' => $paginatedImages->nextPageUrl(),
                'data' => $paginatedImages->items(),
            ];
        });

        return Inertia::render('project/Single/Page', [
            'projects' => [
                'id' => $project->id,
                'title' => $project->title,
                'project_number' => $project->project_number,
                'date_of_award' => $project->date_of_award,
                'contract_sum' => $project->contract_sum,
                'start_date' => $project->start_date,
                'due_date' => $project->due_date,
                'canceled_date' => $project->canceled_date,
                'completed_date' => $project->completed_date,
                'status' => $project->status,
                'progress' => $project->progress,
                'desc' => $project->desc,
                'createdBy' => $project->createdBy,
                'duration' => $project->duration,
                'contractor' => $project->contractors()->where("id",$project->contractor_id)->get(["name"]),
                'milestones' => $project->milestones->map(function ($milestone) {
                    return [
                        'id' => $milestone->id,
                        'contractor' => $milestone->contractors,
                        'progress' => $milestone->progress,
                        'status' => $milestone->status,
                        'created_at' => $milestone->created_at,
                        'name' => $milestone->name,
                    ];
                }),
            ],
            'stages' => $stages,
        ]);
    }
}
