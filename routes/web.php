<?php

use App\Http\Controllers\ContractorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectInfoController;
use App\Http\Controllers\TeamController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function() {
    Route::get("/dashboard", DashboardController::class)->name("dashboard");

    Route::post('/profile/update', [ProfileController::class, "update"])->name("profile.update");
    Route::delete('/profile/delete', [ProfileController::class, "destroy"])->name("profile.delete");
    Route::post('/profile/avatar', [ProfileController::class, "avatar"])->name("avatar.update");

    Route::middleware(['includeProjectId'])->group(function() {
        Route::get("/projects",[ProjectController::class,"index"])->name("project.index");
        Route::post("projects/delete",[ProjectController::class, "DeleteMany"])->name("projects.delete");
        Route::get("/project/{project}",[ProjectController::class,"show"])->name("project.show");
        Route::post("/project/{project}/update",[ProjectController::class,"update"])->name("project.update");
        Route::post("/project/store",[ProjectController::class,"store"])->name("project.store");
        Route::delete('/project/{project}',[ProjectController::class,"destroy"])->name("project.delete");
        
        Route::get("/project/{project}/details",[ProjectInfoController::class, "details"])->name("project.details");
        Route::get("/project/{project}/milestones",[ProjectInfoController::class, "milestones"])->name("project.milestones");
        Route::get("/project/{project}/files",[ProjectInfoController::class, "files"])->name("project.files");
        Route::put("/projects/status/change",[ProjectController::class, "changeStates"])->name("project.status.change");
        Route::post("/project/{project}/assign",[ProjectController::class, "updateAssign"])->name("project.assigned.update");
    });

    Route::get("/contractors",[ContractorController::class,"index"])->name("contractor.index");
    Route::get("/contractor/{contractor}",[ContractorController::class,"show"])->name("contractor.show");
    Route::post("/contractor/{contractor}/update",[ContractorController::class,"update"])->name("contractor.update");
    Route::post("/contractor/store",[ContractorController::class,"store"])->name("contractor.store");
    Route::delete('/contractor/{contractor}',[ContractorController::class,"destroy"])->name("contractor.delete");
    Route::get("/api/contractors",[ContractorController::class,"getContractors"])->name("contractor.api");
    
    Route::get("/teams",[TeamController::class,"index"])->name("team.index");
    Route::post("/team/{user}/update",[TeamController::class,"update"])->name("team.update");
    Route::delete('/team/{user}',[TeamController::class,"destroy"])->name("team.delete");
    Route::get('/team/api',[TeamController::class,"api"])->name("team.api");

    Route::post("/file/store",[FilesController::class,"store"])->name("file.store");
    Route::delete('/file/{file}',[FilesController::class,"destroy"])->name("file.delete");
    Route::delete("/files",[FilesController::class, "multiple"])->name("files.delete");
    
    Route::post("/folder/update",[FolderController::class,"update"])->name("folder.update");
    Route::post("/folder/store",[FolderController::class,"store"])->name("folder.store");
    Route::delete('/folder/{folder}',[FolderController::class,"destroy"])->name("folder.delete");

    Route::post("/milestone/{milestone}/update",[MilestoneController::class,"update"])->name("milestone.update");
    Route::post("/milestone/store",[MilestoneController::class,"store"])->name("milestone.store");
    Route::delete('/milestone/{milestone}',[MilestoneController::class,"destroy"])->name("milestone.delete");
});


require __DIR__.'/auth.php';