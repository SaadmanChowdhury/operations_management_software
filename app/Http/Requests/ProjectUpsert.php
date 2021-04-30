<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectUpsert extends FormRequest
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
            'projectName' => 'required',
            'clientID' => 'required',
            'projectLeaderID' => 'required',
            'orderMonth' => '',
            'inspectionMonth' => '',
            'orderStatus' => '',
            'businessSituation' => '',
            'developmentStage' => '',
            'salesTotal' => 'integer|min:1',
            'transferredAmount' => 'integer|min:1',
            'budget' => 'required|integer|min:1',
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
            'projectName.required' => 'Project name required',
            'clientID.required' => 'Client is required',
            'projectLeaderID.required' => 'Project Leader is required',
            'budget.required' => 'Budget total is required',
            'salesTotal.min:0' => 'salesTotal cannot be negative',
            'transferredAmount.min:0' => 'salesTotal cannot be negative',
            'budget.min:0' => 'budget cannot be negative',
        ];
    }
}
