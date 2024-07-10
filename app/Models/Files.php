<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "folder",
        "stage",
        "userId",
        "projectId"
    ];

    public function uploadedBy() {
        return $this->belongsTo(User::class);
    }

    public function projects() {
        return $this->belongsTo(Project::class);
    }

    public function name() {
        return $this->belongsTo(Folder::class);
    }
}
