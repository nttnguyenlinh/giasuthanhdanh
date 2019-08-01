<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoiMatKhauRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mkht' => 'required',
            'mkm' => [
                'required',
                'regex:/(?=^.{6,20}$)^((?=.*[a-z])(?=.*[A-Z])(?=.*\d)|(?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])|(?=.*[a-z])(?=.*\d)(?=.*[^A-Za-z0-9])|(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]))([A-Za-z\d@#$%^&£*\-_+=[\]{}|\\:\',?\/`~"();!]|\.(?!@)){8,16}$/',
            ],
            'xnmk' => 'required|same:mkm',
        ];
    }

    public function messages()
    {
        return [
            'mkht.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'mkm.required' => 'Vui lòng nhập mật khẩu mới.',
            'mkm.regex' => 'Mật khẩu từ 6-20 ký tự, bao gồm: chữ thường, hoa, số, ký tự đặc biệt như: !@#$%^*()-_+{}|\'"/<>.~=',
            'xnmk.required' => 'Vui lòng nhập lại mật khẩu mới.',
            'xnmk.same' => 'Mật khẩu mới không khớp.',
        ];
    }
}
