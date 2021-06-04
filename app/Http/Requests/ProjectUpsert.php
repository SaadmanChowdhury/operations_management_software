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
            'salesTotal' => 'integer',
            'transferredAmount' => 'integer',
            'budget' => 'required|integer',
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
            'projectName.required' => 'プロジェクト名は必須です',
            'clientID.required' => 'クライアントは必須です',
            'projectLeaderID.required' => 'プロジェクト担当は必須です',
            'budget.required' => '予算の合計が必要です',
            'budget.integer' => '予算を負にすることはできません',
            'salesTotal.integer' => '売上高 に負の値は指定できません',
            'transferredAmount.integer' => '振込金額は負の値にはできません',
            ];
    }
}
