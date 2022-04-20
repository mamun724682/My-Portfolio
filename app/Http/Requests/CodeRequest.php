<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "module_id"   => ['nullable', 'integer', 'gt:0'],
            "name"        => ['required', 'string'],
            "description" => ['nullable', 'string'],
            "code"        => ['required', 'string'],
        ];
    }
}
