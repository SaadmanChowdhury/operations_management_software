<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignUpsert extends FormRequest
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
        $rules = [
            'projectID' => 'required',
            'memberID' => 'required',
            'year' => 'required',
            'month' => 'required',
            'value' => 'required',
        ];

        if ($this->assignID != null) {
            $rules['assignID'] = '';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'projectID' => 'Project is required',
            'memberID' => 'Member is required',
            'year' => 'Year field is required',
            'month' => 'Month field is required',
            'value' => 'Value field is required',
        ];
    }
}
