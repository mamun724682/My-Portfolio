<?php

namespace App\Http\Controllers;

use App\DataTables\ModuleDataTable;
use App\Services\ModuleService;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    protected $moduleService;
    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    public function index(ModuleDataTable $dataTable)
    {
        return $dataTable->render('modules.index');
    }
}
