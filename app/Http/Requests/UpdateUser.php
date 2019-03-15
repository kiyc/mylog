<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Password;

class UpdateUser extends FormRequest
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
            'name'     => 'required|max:255',
            'email'    => 'required|max:255|email|unique:users,email,' . request()->input('id'),
            'password' => ['nullable', new Password()],
        ];
    }

    public function attributes()
    {
        return [
            'name'     => '氏名',
            'email'    => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }
}
