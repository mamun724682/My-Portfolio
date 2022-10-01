<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function __construct()
    {
    }

    public function updateOrCreate($data_array, $id = null)
    {
        try {
            // Update password
            if (isset($data_array['password']) && $data_array['password']) {
                $data_array['password'] = bcrypt($data_array['password']);
            }

            $user = User::updateOrCreate(['id' => $id], $data_array);

            return $user;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
