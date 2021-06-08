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
            'name.required' => '名前が必要です',
            'email.required' => 'メールアドレスが必須です',
            'email.email' => '不正なメールアドレスです。',
            'email.unique:users' => '固有の電子メールである必要があります',
            'tel.required' => '電話番号が必要です',
            'password.required' => 'パスワードが必要です',
            'position.required' => 'ポジションが必要です',
            'location.required' => '職場が必要です',
            'admission_day.required' => '入場日が必要です',
            'unit_price.required' => '原価が必要です',
            // 'unit_price.min:1' => '原価は 1 以上である必要があります',
            // 'user_authority.required' => 'User authority is required',
        ];
    }
}
