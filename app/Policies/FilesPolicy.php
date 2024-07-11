<?php

namespace App\Policies;

use App\Models\Files;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FilesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Files $files): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo("create files");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Files $files): bool
    {
        return $user->hasPermissionTo("edit files") || $files->uploadedBy()->pluck("id") === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Files $files): bool
    {
        return $user->hasPermissionTo("delete files") || $files->uploadedBy()->pluck("id") === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Files $files): bool
    {
        return $user->hasPermissionTo("delete files") || $files->uploadedBy()->pluck("id") === $user->id;
    }
}
