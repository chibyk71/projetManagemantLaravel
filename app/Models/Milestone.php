<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    protected $fillable = [
        "contractorId",
        "projectId",
        "progress",
        "status"
    ];

    public function projects() {
        return $this->belongsTo(Project::class);
    }

    public function contractors() {
        $this->belongsTo(Contractor::class);
    }
    
}
