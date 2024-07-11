<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = User::paginate(50);

        foreach ($teams as $team) {
            $roles = $team->roles()->pluck("name");
            $team["role"] = strtoupper($roles[0]);

        }

        return Inertia::render("Dashboard/Teams", compact("teams"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    public function api() {
        $users = User::all(["id","name"]);

        return Response::json($users);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
    }
}
