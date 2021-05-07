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
            'name' => 'required',
            'password' => '',
            'company' => '',
            'commercial_distribute' => '',
            'tel' => 'required',
            'position' => 'required',
            'location' => 'required',
            'admission_day' => 'required',
            'exit_day' => '',
            'unit_price' => 'required|integer|min:1',
            'user_authority' => '',
            'resign_day' => '',
        ];

        //for creating new user
        if ($this->id == null) {
            $rules['password'] = 'required';
            $rules['email'] = 'required|email|unique:users';
            return $rules;
        }

        // user already exists
        $email = $this->email;
        $userExists = User::where('email', $email)->exists();
        if ($userExists) {
            $rules['id'] = 'required';
            return $rules;
        } else {
            $rules['id'] = 'required';
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
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Has to be email',
            'email.unique:users' => 'Has to be unique email',
            'password.required' => 'Password is required',
            'position.required' => 'Position is required',
            'location.required' => 'Location is required',
            'admission_day.required' => 'Admission day is required',
            'unit_price.required' => 'Unit price is required',
            'unit_price.min:1' => 'Unit price must be at least 1',
            // 'user_authority.required' => 'User authority is required',
        ];
    }
}
