<?php

namespace App\Services;

use App\Models\Code;

class CodeService
{
    public function updateOrCreate($data_array, $id = null)
    {
        try {
            $data = collect($data_array)->only(['module_id', 'name', 'description', 'code'])->toArray();

//            $data['code'] = substr($data['code'], 5, -6);

            $code = Code::updateOrCreate(['id' => $id], $data);

            return $code;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete($id)
    {
        try {
            Code::destroy($id);
            return null;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
