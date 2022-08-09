<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        setPageMeta('Skills');

        $skills = Skill::active()->whereNull('parent_id')->orderBy('serial')->get();

        return view('skills.index', compact('skills'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $data = $request->validate([
            'name' => 'required|string|unique:module_categories,name'
        ]);

        Skill::create($data);

        sendFlash('Skill created successfully');
        return back();
    }

    public function update(Request $request, Skill $skill)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:module_categories,name,'.$module_category->id
        ]);

        $skill->update($data);

        sendFlash('Skill updated successfully');
        return back();
    }

    public function destroy(Skill $skill)
    {
        if ($skill->childs()->count() > 0){
            sendFlash('Skill assigned with sub-skills!', 'error');
            return back();
        }

        $skill->delete();

        sendFlash('Skill deleted successfully');
        return back();
    }
}
