<?php

use App\Http\Controllers\ContractorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\GuestProjectController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectInfoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\TeamController;
use App\Models\Project;
use App\Settings\GeneralSetting;
use App\Settings\WebsiteSetting;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::middleware('auth')->group(function () {
    Route::get("/dashboard", DashboardController::class)->name("dashboard");

    Route::post('/profile/update', [ProfileController::class, "update"])->name("profile.update");
    Route::delete('/profile/delete', [ProfileController::class, "destroy"])->name("profile.delete");
    Route::post('/profile/avatar', [ProfileController::class, "avatar"])->name("avatar.update");

    Route::middleware(['includeProjectId'])->group(function () {
        Route::get("/projects", [ProjectController::class, "index"])->name("project.index");
        Route::post("projects/delete", [ProjectController::class, "DeleteMany"])->name("projects.delete");
        Route::get("/project/{project}", [ProjectController::class, "show"])->name("project.show");
        Route::post("/project/{project}/update", [ProjectController::class, "update"])->name("project.update");
        Route::post("/project/store", [ProjectController::class, "store"])->name("project.store");
        Route::delete('/project/{project}', [ProjectController::class, "destroy"])->name("project.delete");

        Route::get("/project/{project}/details", [ProjectInfoController::class, "details"])->name("project.details");
        Route::get("/project/{project}/milestones", [ProjectInfoController::class, "milestones"])->name("project.milestones");
        Route::get("/project/{project}/files", [ProjectInfoController::class, "files"])->name("project.files");
        Route::put("/projects/status/change", [ProjectController::class, "changeStates"])->name("project.status.change");
        Route::post("/project/{project}/assign", [ProjectController::class, "updateAssign"])->name("project.assigned.update");
    });

    Route::get("/contractors", [ContractorController::class, "index"])->name("contractor.index");
    Route::get("/contractor/{contractor}", [ContractorController::class, "show"])->name("contractor.show");
    Route::post("/contractor/{contractor}/update", [ContractorController::class, "update"])->name("contractor.update");
    Route::post("/contractor/store", [ContractorController::class, "store"])->name("contractor.store");
    Route::delete('/contractor/{contractor}', [ContractorController::class, "destroy"])->name("contractor.delete");
    Route::get("/api/contractors", [ContractorController::class, "getContractors"])->name("contractor.api");

    Route::get("/teams", [TeamController::class, "index"])->name("team.index");
    Route::post("/team/{user}/update", [TeamController::class, "update"])->name("team.update");
    Route::delete('/team/{user}', [TeamController::class, "destroy"])->name("team.delete");
    Route::get('/team/api', [TeamController::class, "api"])->name("team.api");

    Route::post("/file/store", [FilesController::class, "store"])->name("file.store");
    Route::delete('/file/{file}', [FilesController::class, "destroy"])->name("file.delete");
    Route::delete("/files", [FilesController::class, "multiple"])->name("files.delete");

    Route::post("/folder/update", [FolderController::class, "update"])->name("folder.update");
    Route::post("/folder/store", [FolderController::class, "store"])->name("folder.store");
    Route::delete('/folder/{folder}', [FolderController::class, "destroy"])->name("folder.delete");

    Route::post("/milestone/{milestone}/update", [MilestoneController::class, "update"])->name("milestone.update");
    Route::post("/milestone/store", [MilestoneController::class, "store"])->name("milestone.store");
    Route::delete('/milestone/{milestone}', [MilestoneController::class, "destroy"])->name("milestone.delete");

    Route::get("/setting", function() {return Inertia::render("Dashboard/Settings/Page");})->name("setting.index");

    Route::get("setting/general", [SettingController::class, "generalShow"])->name("setting.general.show");
    Route::post("setting/general", [SettingController::class, "generalStore"])->name("setting.general.store");
    
    Route::get("setting/website", [SettingController::class, "websiteShow"])->name("setting.website.show");
    Route::post("setting/website", [SettingController::class, "websiteStore"])->name("setting.website.store");


    Route::get("/setting/roles",[RoleController::class,"index"])->name("role.index");
    Route::post("/create/roles", [RoleController::class, "store"])->name("role.store");
    Route::delete("/role/{role}", [RoleController::class, "destroy"])->name("role.delete");
    Route::get("role/permission/{role}", [RoleController::class, "permissions"])->name("role.permission.show");

    Route::get("setting/sponsors", [SponsorController::class, "index"])->name("sponsor.index");
    Route::post("setting/sponsor", [SponsorController::class, "store"])->name("sponsor.store");
    Route::post("setting/sponsor/{sponsor}", [SponsorController::class, "update"])->name("sponsor.update");
    Route::delete("sponsor/{sponsor}", [SponsorController::class, "destroy"])->name("sponsor.delete");
});

Route::middleware("guest")->group(function () {
    Route::get('/', [GuestProjectController::class, "home"])->name("home");
    Route::get("/about", function (WebsiteSetting $websiteSetting) {
        $totalProjects = Project::count();
        $completedProjects = Project::where('status', 'COMPLETED')->count();
        $ongoingProjects = Project::where('status', 'IN_PROGRESS')->count();

        return Inertia::render("About", ["data"=> [
            'total_projects' => $totalProjects,
            'completed_projects' => $completedProjects,
            'ongoing_projects' => $ongoingProjects,
            "about_img" => $websiteSetting->about_img,
            "mission"=> $websiteSetting->mission
        ]]);
    })->name("about");

    Route::get("projects", [GuestProjectController::class, "index"])->name("guest.projects");
    Route::get("project/{project}", [GuestProjectController::class, "show"])->name("guest.project.show");
    Route::get("sponsor/api", [SponsorController::class, "api"])->name('sponsor.api');
});


require __DIR__ . '/auth.php';
