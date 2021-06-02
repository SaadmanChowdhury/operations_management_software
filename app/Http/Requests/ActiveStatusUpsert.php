<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActiveStatusUpsert extends FormRequest
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
            'item_type' => 'required',
            'item_id' => 'required',
            'favorite_status' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'item_type.required' => 'item_type is required',
            'item_id.required' => 'item_id is required',
            'favorite_status.required' => 'favorite_status is required',
        ];
    }
}
