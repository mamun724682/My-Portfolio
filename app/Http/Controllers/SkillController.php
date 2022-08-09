<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkillRequest;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        setPageMeta('Skills');

        $skills = Skill::whereNull('parent_id')->orderBy('serial')->get();

        return view('skills.index', compact('skills'));
    }

    public function store(SkillRequest $request)
    {
        $data = $request->validated();

        if (! $request->status){
            $data = $request->validated() + ['status' => false];
        }

        Skill::create($data);

        sendFlash('Skill created successfully');
        return back();
    }

    public function update(SkillRequest $request, Skill $skill)
    {
        if (! $request->status){
            $data = $request->validated() + ['status' => false];
        }else {
            $data = $request->validated() + ['status' => true];
        }

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
