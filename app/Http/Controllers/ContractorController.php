<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;

class ContractorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contractors = Contractor::paginate(50);
        return Inertia::render("Dashboard/Contractors/Page",compact("contractors"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(["name"=>"alpha_num|required|min:3","email"=>"email|sometimes","url"=>"sometimes|url"]);

        Contractor::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contractor $contractor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contractor $contractor)
    {
        $validated = $request->validate(["name"=>"|sometimes|required|min:3","email"=>"sometimes|email","url"=>"sometimes|url"]);

        $contractor->update($validated);
    }

    public function api() {
        $contractors = Contractor::all(["id","name"]);
        return Response::json($contractors);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contractor $contractor)
    {
        $contractor->delete();
    }
}
