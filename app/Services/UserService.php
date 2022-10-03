<?php

namespace App\Services;

use App\Models\User;
use App\Services\Common\FileUploadService;

class UserService
{
    public function __construct(private FileUploadService $fileUploadService)
    {
    }

    public function updateOrCreate($data_array, $id = null)
    {
//        foreach ($data_array['about'] as $item) {
//            $about[$item[0]] = $item[1];
//        }
//        dd($about);
        try {
            // Update password
            if (isset($data_array['password']) && $data_array['password']) {
                $data_array['password'] = bcrypt($data_array['password']);
            }

            // Upload profile image
            if (isset($data_array['profile_image']) && $data_array['profile_image']){
                $data_array['profile_image'] = $this->fileUploadService->uploadFile($data_array['profile_image'], 'uploads/profile', 'random', auth()->user()->profile_image);
            }

            // Upload banner image
            if (isset($data_array['banner_image']) && $data_array['banner_image']){
                $data_array['banner_image'] = $this->fileUploadService->uploadFile($data_array['banner_image'], 'uploads/profile', 'random', auth()->user()->banner_image);
            }

            // Upload cv file
            if (isset($data_array['cv_file']) && $data_array['cv_file']){
                $data_array['cv_file'] = $this->fileUploadService->uploadFile($data_array['cv_file'], 'uploads/profile', 'CV Mamun', auth()->user()->cv_file);
            }

            // Process about
            if (isset($data_array['about']) && $data_array['about']){
                $data_array['about'] = json_encode($data_array['about']);
            }

//            dd($data_array);

            $user = User::updateOrCreate(['id' => $id], $data_array);

            return $user;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
