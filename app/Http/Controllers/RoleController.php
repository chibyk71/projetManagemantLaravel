<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all(["name","id"]);

        foreach ($roles as $role) {
            $role["users"] = $role->users()->count();
        }

        return Inertia::render("Dashboard/Settings/Roles/Page",compact("roles"));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        "name"=> "required|string",
        
        "file" => "nullable|array",
        "file.*" => "in:none,view,create,edit,delete,all",
        
        "folder" => "nullable|array",
        "folder.*" => "in:none,view,create,edit,delete,all",
        
        "milestone" => "nullable|array",
        "milestone.*" => "in:none,view,create,edit,delete,all",
        
        "project" => "nullable|array",
        "project.*" => "in:none,view,create,edit,delete,all",
        
        "team" => "nullable|array",
        "team.*" => "in:none,view,create,edit,delete,all",
    ]);

    $allowed = ["edit", "view", "create", "delete"];

    $role_name = $validated["name"];
    try {
        $role = Role::createOrFirst(["name" => $role_name]);
        unset($validated["name"]);

        foreach ($validated as $resource => $permission) {
            // Skip if the permission array contains only "none"
            if (in_array("none", $permission) && count($permission) >= 1) {
                continue;
            }

            // Permissions to assign to role 
            $permissions = [];

            // Change "team" to "user" since there is no "team" model
            $resource = ($resource == "team") ? "user" : $resource;

            // The selected permissions to assign is an array so we loop through them
            foreach ($permission as $permit) {
                // If "all" is selected, assign all permissions for that resource
                if ($permit === "all") {
                    foreach ($allowed as $key) {
                        $permissions[] = $key . " " . $resource . "s";
                    }
                    break; // No need to check other permissions if "all" is selected
                } else if ($permit !== "none") {
                    $permissions[] = $permit . " " . $resource . "s";
                }
            }

            if ($permissions) {
                $role->givePermissionTo($permissions);
            }
        }
        
        return redirect()->back();
    } catch (\Throwable $th) {
        Log::info($th);
        return response($th, 500);
    }
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            "name"=> "required|string",
            
            "file" => "nullable|array",
            "file.*" => "in:none,view,create,edit,delete,all",
            
            "milestone" => "nullable|array",
            "milestone.*" => "in:none,view,create,edit,delete,all",
            
            "project" => "nullable|array",
            "project.*" => "in:none,view,create,edit,delete,all",
            
            "team" => "nullable|array",
            "team.*" => "in:none,view,create,edit,delete,all",
        ]);
        unset($validated["name"]);
        $allowed = ["edit", "view", "create", "delete"];
        try {
            $role->permissions()->detach();

            foreach ($validated as $resource => $permission) {
                // Skip if the permission array contains only "none"
                if (in_array("none", $permission) && count($permission) >= 1) {
                    continue;
                }
    
                // Permissions to assign to role 
                $permissions = [];
    
                // Change "team" to "user" since there is no "team" model
                $resource = ($resource == "team") ? "user" : $resource;
    
                // The selected permissions to assign is an array so we loop through them
                foreach ($permission as $permit) {
                    // If "all" is selected, assign all permissions for that resource
                    if ($permit === "all") {
                        foreach ($allowed as $key) {
                            $permissions[] = $key . " " . $resource . "s";
                        }
                        break; // No need to check other permissions if "all" is selected
                    } else if ($permit !== "none") {
                        $permissions[] = $permit . " " . $resource . "s";
                    }
                }
    
                if ($permissions) {
                    $role->givePermissionTo($permissions);
                }
            }
            
            return redirect()->back();
        } catch (\Throwable $th) {
            Log::info($th);
            return response($th, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
    }

    public function permissions(Role $role) {
        $permissionColleecion = $role->getAllPermissions()->pluck("name");

        $activePermisions = [];

        foreach ($permissionColleecion as $key => $val) {
            $wordArr = str_word_count($val, 1);
            $permitted = $wordArr[0];
            $resource = rtrim($wordArr[1],"s");

            $activePermisions[$resource][] = $permitted;
        }
        return Response::json($activePermisions);
    }
}
