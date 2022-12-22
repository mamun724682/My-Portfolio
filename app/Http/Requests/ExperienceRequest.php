<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'company_name' => 'required|string',
            'company_url'  => 'nullable|url',
            'designation'  => 'required|string',
            'from_date'    => 'required|date',
            'to_date'      => 'nullable|date',
            'location'     => 'string|nullable',
            'details'      => 'string|nullable',
        ];
    }
}
