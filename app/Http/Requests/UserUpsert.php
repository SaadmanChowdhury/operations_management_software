<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpsert extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'company' => '',
            'commercial_distribute' => '',
            'tel' => 'required',
            'position' => 'required',
            'location' => 'required',
            'admission_day' => 'required',
            'exit_day' => '',
            'unit_price' => 'required',
            'user_authority' => 'required',
            'resign_day' => '',
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
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Has to be email',
            'email.unique:users' => 'Has to be unique email',
            'password.required' => 'Password is required',
            'position.required' => 'Position is required',
            'location.required' => 'Location is required',
            'admission_day.required' => 'Admission day is required',
            'unit_price.required' => 'Unit price is required',
            'user_authority.required' => 'User authority is required',
        ];
    }
}
