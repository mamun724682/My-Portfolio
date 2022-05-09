<?php

namespace App\Http\Controllers;

use App\Models\ModuleCategory;
use Illuminate\Http\Request;

class ModuleCategoryController extends Controller
{
    public function index()
    {
        setPageMeta('Module Categories');

        $categories = ModuleCategory::latest()->get();

        return view('module_categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string'
        ]);

        ModuleCategory::create($data);

        sendFlash('Category created successfully');
        return back();
    }

    public function destroy(ModuleCategory $module_category)
    {
        if ($module_category->modules()->count() > 0){
            sendFlash('Category assigned with modules!', 'error');
            return back();
        }

        $module_category->delete();

        sendFlash('Category deleted successfully');
        return back();
    }
}
