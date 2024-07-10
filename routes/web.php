<?php

use App\Http\Controllers\ContractorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\MilestoneController;
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

    Route::get("/projects",[ProjectController::class,"index"])->name("project.index");
    Route::get("/project/{id}",[ProjectController::class,"show"])->name("project.show");
    Route::post("/project/{id}/update",[ProjectController::class,"update"])->name("project.update");
    Route::post("/project/{id}/store",[ProjectController::class,"store"])->name("project.store");
    Route::delete('/project/{id}',[ProjectController::class,"destroy"])->name("project.delete");

    Route::get("/contractors",[ContractorController::class,"index"])->name("contractor.index");
    Route::get("/contractor/{id}",[ContractorController::class,"show"])->name("contractor.show");
    Route::post("/contractor/{id}/update",[ContractorController::class,"update"])->name("contractor.update");
    Route::post("/contractor/{id}/store",[ContractorController::class,"store"])->name("contractor.store");
    Route::delete('/contractor/{id}',[ContractorController::class,"destroy"])->name("contractor.delete");
    
    Route::get("/teams",[TeamController::class,"index"])->name("team.index");
    Route::post("/team/{id}/update",[TeamController::class,"update"])->name("team.update");
    Route::delete('/team/{id}',[TeamController::class,"destroy"])->name("team.delete");

    Route::get("/project/{id}/details",[ProjectInfoController::class, "details"]);
    Route::get("/project/{id}/milestones",[ProjectInfoController::class, "milestones"]);
    Route::get("/project/{id}/files",[ProjectInfoController::class, "files"]);

    Route::post("/file/{id}/update",[FilesController::class,"update"])->name("file.update");
    Route::post("/file/{id}/store",[FilesController::class,"store"])->name("file.store");
    Route::delete('/file/{id}',[FilesController::class,"destroy"])->name("file.delete");
    Route::delete("/files",FilesController::class)->name("files.delete");

    Route::post("/milestone/{id}/update",[MilestoneController::class,"update"])->name("milestone.update");
    Route::post("/milestone/{id}/store",[MilestoneController::class,"store"])->name("milestone.store");
    Route::delete('/milestone/{id}',[MilestoneController::class,"destroy"])->name("milestone.delete");
});


require __DIR__.'/auth.php';