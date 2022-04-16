<?php

namespace App\Services;

use App\Models\Module;

class ModuleService
{
    public function updateOrCreate($data_array, $id = null)
    {
        try {
            $data = collect($data_array)->only(['parent_id', 'type', 'name', 'description', 'is_single', 'status'])->toArray();

            $data['is_single'] = isset($data_array['is_single']) ? 1 : 0;
            $data['status'] = isset($data_array['status']) ? 1 : 0;

            $module = Module::updateOrCreate(['id' => $id], $data);

            return $module;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deleteCategory($id)
    {
        try {
            Category::destroy($id);
            return null;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
