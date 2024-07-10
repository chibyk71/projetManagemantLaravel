<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "email",
        "url"
    ];

    public function projects() {
        return $this->hasMany(Project::class);
    }

    public function milestones() {
        return $this->hasMany(Milestone::class);
    }
}
