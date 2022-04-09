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
        setPageMeta('Modules');
        return $dataTable->render('modules.index');
    }

    public function create()
    {
        setPageMeta('Create Module');
        return view('modules.create');
    }

    public function store(UserRequest $request)
    {
        if ($this->userService->updateOrCreate($request))
            sendFlash('User created successfully', 'success');

        return redirect()->route('users.index');
    }
}
