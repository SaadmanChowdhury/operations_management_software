<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'project_name' => 'required',
            'client_id' => 'required',
            'manager_id' => 'required',
            'order_month' => '',
            'inspection_month' => '',
            'order_status' => '',
            'business_situation' => '',
            'development_stage' => '',
            'sales_total' => 'required',
            'transferred_amount' => '',
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
            'project_name.required' => 'Project name required',
            'client_id.required' => 'Client is required',
            'manager_id.required' => 'Manager is required',
            'sales_total.required' => 'Sales total is required',
        ];
    }
}
