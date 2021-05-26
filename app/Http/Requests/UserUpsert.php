<?php

namespace App\Http\Requests;

use App\Models\User;
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
        $rules = [
            'userCode' => 'required|unique:users',
            'userName' => 'required',
            'email' => 'required',
            'password' => '',
            'gender' => '',
            'location' => 'required',
            'tel' => 'required',
            'position' => 'required',
            'employeeClassification' => '',
            'affiliationID' => '',
            'emergencyContact' => '',
            'condition1' => '',
            'condition2' => '',
            'locker' => '',
            'userAuthority' => '',
            'remark' => '',
        ];

        $rules['compositeSalary'] = [
            'salaryID' => '',
            'startDate' => '',
            'endDate' => '',
            'salaryAmount' => '',
        ];

        $rules['compositeEmployment'] = [
            'employmentID' => '',
            'startDate' => '',
            'endDate' => '',
            'isResign' => '',
        ];

        //for creating new user
        if ($this->userID == null) {
            $rules['password'] = 'required';
            $rules['email'] = 'required|email|unique:users';
            return $rules;
        }

        // user already exists
        $email = $this->email;
        $userExists = User::where('email', $email)->exists();
        if ($userExists) {
            $rules['userID'] = 'required';
            return $rules;
        } else {
            $rules['userID'] = 'required';
            $rules['email'] = 'required|email|unique:users';
            return $rules;
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'userCode.required' => 'Name is required',
            'userName.required' => 'Username is required',
            'email.required' => 'Email is required',
            'email.email' => 'Has to be email',
            'email.unique:users' => 'Has to be unique email',
            'password.required' => 'Password is required',
            'position.required' => 'Position is required',
            'location.required' => 'Location is required',
            'admission_day.required' => 'Admission day is required',
            'unit_price.required' => 'Unit price is required',
            'unit_price.min:1' => 'Unit price must be at least 1',
        ];
    }
}
