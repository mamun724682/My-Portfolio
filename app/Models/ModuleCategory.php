<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function modules()
    {
        return $this->hasMany(Module::class, 'category_id');
    }
}
