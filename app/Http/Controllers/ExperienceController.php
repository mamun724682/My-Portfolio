<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperienceRequest;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        setPageMeta('Experiences');

        $experiences = Experience::latest()->get();

        return view('experiences.index', compact('experiences'));
    }

    public function store(ExperienceRequest $request)
    {
        $data = $request->validated();

        if (!$request->status) {
            $data = $request->validated() + ['status' => false];
        }

        Experience::create($data);

        sendFlash('Experience created successfully');
        return back();
    }

    public function update(ExperienceRequest $request, Experience $experience)
    {
        if (!$request->status) {
            $data = $request->validated() + ['status' => false];
        } else {
            $data = $request->validated() + ['status' => true];
        }

        $experience->update($data);

        sendFlash('Experience updated successfully');
        return back();
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();

        sendFlash('Experience deleted successfully');
        return back();
    }
}
