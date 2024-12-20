<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Services\Common\FileUploadService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(private FileUploadService $fileUploadService)
    {
    }

    public function index()
    {
        setPageMeta('Projects');

        $projects = Project::latest()->get();

        return view('projects.index', compact('projects'));
    }

    public function store(ProjectRequest $request)
    {
        $data = $request->validated();

        if (!$request->status) {
            $data = $request->validated() + ['status' => false];
        }

        // Upload profile image
        if (count($data['images']) >= 1){
            $images = [];
            foreach ($data['images'] as $image) {
                $images[] = $this->fileUploadService->uploadFile($image, Project::PROJECT_IMAGES_PATH, 'original');
            }
            unset($data['images']);
            $data['images'] = json_encode($images);
        }

        Project::create($data);

        sendFlash('Project created successfully');
        return back();
    }

    public function update(ProjectRequest $request, Project $project)
    {
        if (!$request->status) {
            $data = $request->validated() + ['status' => false];
        } else {
            $data = $request->validated() + ['status' => true];
        }

        if (count($data['images']) >= 1) {
            $oldImages = json_decode($project->images);
            if ($oldImages){
                foreach ($oldImages as $imagePath) {
                    $this->fileUploadService->delete($imagePath);
                }
            }

            $images = [];
            foreach ($data['images'] as $image) {
                $images[] = $this->fileUploadService->uploadFile(
                    file: $image,
                    upload_path: Project::PROJECT_IMAGES_PATH,
                    set_file_name: 'original',
                );
            }
            unset($data['images']);
            $data['images'] = json_encode($images);
        }

        $project->update($data);

        sendFlash('Project updated successfully');
        return back();
    }

    public function destroy(Project $project)
    {
        // Delete profile images
        $images = json_decode($project->images);
        if (count($images) >= 1){
            foreach ($images as $image) {
                $this->fileUploadService->delete(Project::PROJECT_IMAGES_PATH.'/'.$image);
            }
        }

        $project->delete();

        sendFlash('Project deleted successfully');
        return back();
    }
}
