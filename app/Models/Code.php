<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const CODE_MODES = [
        'css'        => 'Css',
        'php'        => 'Php',
        'vue'        => 'Vue',
        'javascript' => 'Javascript',
        'htmlmixed'  => 'Htmlmixed for xml, css & js'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
