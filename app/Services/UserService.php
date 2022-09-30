<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function updateOrCreate($data_array, $id = null)
    {
        try {
            $user = User::updateOrCreate(['id' => $id], $data_array);

            return $user;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
