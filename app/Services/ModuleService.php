<?php

namespace App\Services;

use App\Models\Module;

class ModuleService
{
    public function updateOrCreate($data_array, $id = null)
    {
        try {
            $data = collect($data_array)->only(['parent_id', 'category_id', 'name', 'description', 'tags', 'status'])->toArray();

            $data['status'] = isset($data_array['status']) ? 1 : 0;

            $module = Module::updateOrCreate(['id' => $id], $data);

            return $module;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete($id)
    {
        try {
            $module = Module::findOrFail($id);

            throw_if($module->codes()->count() > 0 || $module->childs()->count() > 0, new \Exception('Assigned with codes or child modules!'));

            $module->delete($id);

            return null;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
