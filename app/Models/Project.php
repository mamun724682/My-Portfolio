<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    const PROJECT_IMAGES_PATH = "uploads/projects";

    protected $guarded = ['id'];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
