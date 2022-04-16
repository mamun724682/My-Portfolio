<?php

namespace App\Http\Controllers;

use App\DataTables\ModuleDataTable;
use App\Http\Requests\ModuleRequest;
use App\Models\Module;
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

    public function store(ModuleRequest $request)
    {
        try {
            $module = $this->moduleService->updateOrCreate($request->all());
            sendFlash('Module created successfully');
            return redirect()->route('modules.edit', $module->id);
        } catch (\Exception $e) {
            sendFlash($e->getMessage(), 'error');
            return back()->withInput();
        }
    }

    public function edit(Module $module)
    {
        setPageMeta('Edit Module');
        return view('modules.edit', compact('module'));
    }

    public function update(ModuleRequest $request, $id)
    {
        try {
            $module = $this->moduleService->updateOrCreate($request->all(), $id);
            sendFlash('Module updated successfully');
            return back();
        } catch (\Exception $e) {
            sendFlash($e->getMessage(), 'error');
            return back()->withInput();
        }
    }
}
