<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'contractorId',
        'project_number',
        "date_of_award",
        "contract_sum",
        "start_date",
        "due_date",
        "canceled_date",
        "completed_date",
        "status",
        "progress",
        "desc",
        "createdBy",
        "duration"
    ];

    public function assignedUsers()
    {
        return $this->belongsToMany(User::class, 'project_assigned', 'projectId', 'userId')->withTimestamps();
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }

    public function contractors()
    {
        return $this->belongsTo(Contractor::class);
    }

    public function folders() {
        return $this->hasMany(Folder::class);
    }
}
