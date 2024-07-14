<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "folder_id",
        "stage",
        "userId",
    ];

    public function uploadedBy() {
        return $this->belongsTo(User::class, "userId");
    }

    public function folder() {
        return $this->belongsTo(Folder::class);
    }
}
