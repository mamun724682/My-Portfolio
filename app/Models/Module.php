<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const STATUS_ACTIVE = true;

    public function category()
    {
        return $this->belongsTo(ModuleCategory::class, 'category_id');
    }

    public function childs()
    {
        return $this->hasMany(Module::class, 'parent_id');
    }

    public function codes()
    {
        return $this->hasMany(Code::class, 'module_id');
    }

}
