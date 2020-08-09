<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class loginFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() == 'login') {
            return true;
        }else{
            return false;
        }
        // return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|exists:t_users,user_id',
            'login_password' => 'required',
        ];
    }

    public function messages()
    {

        return [
            'user_id.required' => 'ユーザー名とパスワードを入力してください。',
            // 'user_id.max' => 'ユーザー名は9文字以内で入力してください。',
            // 'user_id.starts_with' => 'ユーザー名の頭文字はdから始まります。',
            'user_id.exists' => 'ユーザー名、またはパスワードが間違っています。',
            'login_password.required' => 'ユーザー名とパスワードを入力してください。',
            // 'login_password.max' => 'パスワードは5文字以内で入力してください。',
            // 'login_password.numeric' => 'パスワードは整数で入力してください。',
        ];
    }
}
