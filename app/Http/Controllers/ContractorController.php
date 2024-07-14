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
        $contractors = Contractor::with(["projects","milestones"])->paginate(50);
        $contractors->getCollection()->transform(function ($contractor) {
            return [
                "id" => $contractor->id,
                "name" => $contractor->name,
                "email" => $contractor->email,
                "url" => $contractor->url,
                "projects" => $contractor->projects->count()+$contractor->milestones->count(),
            ];
        });

        $pagination = [
            "total" => $contractors->total(),
            "next_page_url" => $contractors->nextPageUrl(),
        ];

        return Inertia::render("Dashboard/Contractors/Page", [
            "contractors" => $contractors,
            "pagination" => $pagination,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(["name" => "alpha_num|required|min:3", "email" => "email|sometimes", "url" => "sometimes|url"]);

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
        $validated = $request->validate(["name" => "|sometimes|required|min:3", "email" => "sometimes|email", "url" => "sometimes|url"]);

        $contractor->update($validated);
    }

    public function getContractors()
    {
        $contractors = Contractor::all(["id", "name"]);
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
