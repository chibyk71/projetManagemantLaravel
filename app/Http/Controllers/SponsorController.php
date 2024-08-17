<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use RahulHaque\Filepond\Facades\Filepond;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sponsors = Sponsor::all(["name","id","title","image","description"])->toArray();
        return Inertia::render("Dashboard/Settings/Sponsor/Page", compact("sponsors"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name"=> "required|string",
            "title" => "required|string",
            "image" => Rule::filepond(["required","image","max:5000"]),
            "description" => "string|sometimes"
        ]);

        $namec = hash( "sha256", rand());
        $info = Filepond::field($validated["image"])->moveTo("team/".$namec);

        $validated["image"] = $info["location"];

        Sponsor::create($validated);

        // return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update( Request $request, Sponsor $sponsor)
    {
        $validated = $request->validate([
            "name"=> "required|string",
            "title" => "required|string",
            "image" => Rule::filepond(["sometimes","image","max:5000","nullable"]),
            "description" => "string|sometimes",
        ]);

        if ($validated["image"] !== null ) {
            File::delete($sponsor->image);
            $namec = hash( "sha256", rand());
            $info = Filepond::field($validated["image"])->moveTo("team/".$namec);
            $validated["image"] = $info["location"];
        }

        if ($validated["image"] == null) {
            unset($validated["image"]);
        }
        Log::info($validated);
        $sponsor->update($validated);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsor $sponsor)
    {
        $sponsor->delete();
    }

    public function api() {
        return Response::json(Sponsor::all(["name","image","title","description"])->toArray());
    }
}
