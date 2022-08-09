<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function childs()
    {
        return $this->hasMany(Skill::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Skill::class, 'parent_id');
    }
}
